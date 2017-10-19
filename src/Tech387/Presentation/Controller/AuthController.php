<?php

namespace Tech387\Presentation\Controller;

use Symfony\Component\HttpFoundation\Request;

use Tech387\Models\Services\AuthService;

class AuthController
{

    private $authService;
    
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function getLogin(Request $request)
    {
        $login = $this->authService->getLogin();
        return $login;
    }

    public function getCallback(Request $request)
    {
        $callback = $request->get('code');
        $post = $this->authService->callback($callback);
        return $post;
    }

    public function postToken(Request $request)
    {
        $object = \OAuth2\Request::createFromGlobals();
        
        return $this->authService->returnToken($object);
    }

}