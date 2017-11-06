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
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

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

        try{
            $parameters = $matcher->match($request->getPathInfo());
            
            foreach ($parameters as $key => $value) {
                $request->attributes->set($key, $value);
            }
    
            $command = $request->getMethod() . $request->get('action');
            $resource = "controller.{$request->get('controller')}";
    
            $controller = $container->get($resource);
            $data = $controller->{$command}($request);

            
        }catch(\Error $e){
            $data = [
                'status'=>404,
                'message'=>'Not found',
                'info'=>$e->getMessage()
            ];
        }catch(\Symfony\Component\Routing\Exception\MethodNotAllowedException $e){
            $data = [
                'status'=>404,
                'message'=>'Not found',
                'info'=>$e->getMessage()
            ];
        }catch(ResourceNotFoundException $e){
            $data = [
                'status'=>404,
                'message'=>'Not found',
                'info'=>$e->getMessage()
            ];
        }

        //Display Image
        if(isset($data['image'])){
            $response = new Response();
            $file = $data['image'];
            $response->headers->set('Content-Type', 'image/jpeg');
            $response->setContent(file_get_contents($file));//TODO
        }else{
            $response = new JsonResponse($data);
        }

        //Set cors headers
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE');
        
        $response->send();
    }

}