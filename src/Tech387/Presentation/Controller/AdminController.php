<?php

namespace Tech387\Presentation\Controller;

use Symfony\Component\HttpFoundation\Request;

use Tech387\Models\Services\AdminService;
use Tech387\Models\Services\BlogService;
use Tech387\Models\Services\NewsLetterService;

class AdminController
{

    private $adminService;
    private $blogService;
    private $newsLetterService;

    public function __construct(AdminService $adminService, BlogService $blogService, NewsLetterService $newsLetterService)
    {
        $this->adminService = $adminService;
        $this->blogService = $blogService;
        $this->newsLetterService = $newsLetterService;
    }

    /**
     * Get Post
     */
    public function getPost(Request $request)//TODO
    {
        $slug = $request->get('slug');

        $post = $this->blogService->getPost($slug);
        return $post;
    }

    /**
     * Insert Post
     */
    public function postPost(Request $request)//TODO
    {
        $params = json_decode($request->getContent(), true);
 
        $name = $params['name'];
        $body = $params['body'];
        $tags = $params['tags'];
        $images = $params['images'];

        $post = $this->blogService->insertPost($name,$body,$tags,$images);
        return $post;
    }

    /**
     * Delete Post
     */
    public function deletePost(Request $request)//TOOD
    {
        $slug = $request->get('slug');
        
        $post = $this->blogService->deletePost($slug);
        return $post;
    }

    /**
     * Edit Post
     */
    public function putPost(Request $request)//TOOD
    {
        return ['action'=>'put_post'];
    }

    /**
     * Get Posts
     */
    public function getPosts(Request $request)//TODO
    {
        $post = $this->blogService->getPosts();
        return $post;
    }

    /**
     * Get Suggested
     */
    public function getSuggestions(Request $request)//TODO
    {
        return ['action'=>'get_suggested'];
    }

    /**
     * Insert Newsletter
     */
    public function postNewsletter(Request $request)//TOOD
    {
        return ['action'=>'post_newsletter'];
    }

    /**
     * Get Newsletter
     */
    public function getNewsletter(Request $request)//TOOD
    {
        return ['action'=>'get_newsletter'];
    }

}