<?php

namespace Tech387\Bootstrap;

//Imports
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection;
use Symfony\Component\Routing;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\HttpFoundation\JsonResponse;


class Bootstrap
{

    public function __construct()
    {
        $request = Request::createFromGlobals();
        $locator = new FileLocator(__DIR__ . '/../../../config');

        // DI container
        $container = new DependencyInjection\ContainerBuilder;

        $loader = new DependencyInjection\Loader\YamlFileLoader($container, $locator);
        $loader->load('config-development.yml');

        $container->compile();

        // routing
        $loader = new Routing\Loader\YamlFileLoader($locator);
        $context = new Routing\RequestContext();
        $context->fromRequest($request);
        $matcher = new Routing\Matcher\UrlMatcher(
            $loader->load('routing.yml'),
            $context
        );

        $parameters = $matcher->match($request->getPathInfo());
    
        foreach ($parameters as $key => $value) {
            $request->attributes->set($key, $value);
        }

        $command = $request->getMethod() . $request->get('action');
        $resource = "controller.{$request->get('controller')}";

        $controller = $container->get($resource);

        $data = $controller->{$command}($request);

        $response = new JsonResponse($data);
        $response->send();

    }

}