<?php

namespace Tech387\Presentation\Controller;

use Symfony\Component\HttpFoundation\Request;

use Tech387\Models\Services\AdminService;
use Tech387\Models\Services\BlogService;
use Tech387\Models\Services\NewsLetterService;
use Tech387\Models\Services\AuthService;
use Symfony\Component\Config\Definition\Exception\Exception;

class AdminController
{

    private $adminService;
    private $blogService;
    private $newsLetterService;
    private $authService;

    public function __construct(AdminService $adminService, BlogService $blogService, NewsLetterService $newsLetterService, AuthService $authService)
    {
        $this->adminService = $adminService;
        $this->blogService = $blogService;
        $this->newsLetterService = $newsLetterService;
        $this->authService = $authService;
    }

    /**
     * Get Post
     */
    public function getPost(Request $request)
    {
        $slug = $request->get('slug');

        $post = $this->blogService->getPost($slug);
        return $post;
    }

    /**
     * Insert Post
     */
    public function postPost(Request $request)
    {
 
        if($this->authService->handleRequestValidity()){
            $params = json_decode($request->getContent(), true);
            
            $name = $params['name'];
            $body = $params['body'];
            $tags = $params['tags'];
            $images = $params['images'];
    
            $post = $this->blogService->insertPost($name,$body,$tags,$images);
            return $post;
        }
        return [
            'status'=>406,
            'message'=>'access not allowed'
        ];
        
    }

    /**
     * Delete Post
     */
    public function deletePost(Request $request)
    {
        if($this->authService->handleRequestValidity()){
            $slug = $request->get('id');
            
            $post = $this->blogService->deletePost($slug);
            return $post;
        }

        return [
            'status'=>406,
            'message'=>'access not allowed'
        ];
    }

    /**
     * Edit Post
     */
    public function putPost(Request $request)
    {
        if($this->authService->handleRequestValidity()){
            $params = json_decode($request->getContent(), true);
            
            $id = $request->get('id');

            $name = $params['name'];
            $body = $params['body'];
            $tags = $params['tags'];
            $images = $params['images'];

            $post = $this->blogService->editPost($id,$name,$body,$tags,$images);
            return $post;
        }

        return [
            'status'=>406,
            'message'=>'access not allowed'
        ];
    }

    /**
     * Get Posts
     */
    public function getPosts(Request $request)
    {
        $post = $this->blogService->getPosts();
        return $post;
    }

    /**
     * Get Suggested
     */
    public function getSuggestions(Request $request)
    {
        $post = $this->blogService->getSuggestions();
        return $post;
    }

    /**
     * Upload Image
     */
    public function postImage(Request $request)
    {
        if($this->authService->handleRequestValidity()){
            $file = $request->files->get('image'); 
            
            $post = $this->blogService->postImage($file);
            return $post;
        }

        return [
            'status'=>406,
            'message'=>'access not allowed'
        ];

    }  
    
    /**
     * Get image
     */
    public function getImage(Request $request)
    {
        $name = $request->get('slug');
        $get = $this->blogService->getImage($name);
        
        return $get;
    }

    /**
     * Insert Newsletter
     */
    public function postNewsletter(Request $request)
    {
        $params = json_decode($request->getContent(), true);
        
        $mail = $params['mail'];
        
        $newsletter = $this->newsLetterService->insertMail($mail);
        return $newsletter;
    }

    /**
     * Get Newsletter
     */
    public function getNewsletter(Request $request)
    {
        if($this->authService->handleRequestValidity()){
            $newsletter = $this->newsLetterService->getMails();
            return $newsletter;
        }

        return [
            'status'=>406,
            'message'=>'access not allowed'
        ];
    }

}