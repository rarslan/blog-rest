<?php

namespace Tech387\Bootstrap;

use Symfony\Component\Routing;

$routes = new Routing\RouteCollection();
$routes->add('AdminController', new Routing\Route('/hello'));
$routes->add('bye', new Routing\Route('/bye'));

return $routes;