<?php

namespace Tech387\Presentation\Controller;

use Symfony\Component\HttpFoundation\Request;
use Tech387\Models\Services\AuthService;
use Tech387\Models\Services\FaqService;
use Symfony\Component\Config\Definition\Exception\Exception;

class FaqController
{

    private $faqService;
    private $authService;

    public function __construct(FaqService $faqService,AuthService $authService)
    {
        $this->faqService = $faqService;
        $this->authService = $authService;
    }

    public function post(Request $request)
    {
        if($this->authService->handleRequestValidity()){

            $params = json_decode($request->getContent(), true);
            
            $question = $params['question'];
            $answer = $params['answer'];

            $post = $this->faqService->postFaq($question,$answer);
            return $post;
        }
        return [
            'status'=>406,
            'message'=>'access not allowed'
        ];
    }

    public function put(Request $request)
    {
        if($this->authService->handleRequestValidity()){
            $id = $request->get('id');

            $params = json_decode($request->getContent(), true);
            
            $question = $params['question'];
            $answer = $params['answer'];

            $post = $this->faqService->putFaq($id,$question,$answer);
            return $post;
        }
        return [
            'status'=>406,
            'message'=>'access not allowed'
        ];
    }

    public function get(Request $request)
    {
        $get = $this->faqService->getFaq();
        return $get;
    }

    public function delete(Request $request)
    {
        if($this->authService->handleRequestValidity()){
            $id = $request->get('id');

            $post = $this->faqService->deleteFaq($id);
            return $post;
        }
        return [
            'status'=>406,
            'message'=>'access not allowed'
        ];
    }

}