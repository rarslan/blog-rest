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
    public function getPost()//TODO
    {
        return ['action'=>'get_post'];
    }

    /**
     * Insert Post
     */
    public function postPost()//TODO
    {
        return ['action'=>'post_post'];
    }

    /**
     * Delete Post
     */
    public function deletePost()//TOOD
    {
        return ['action'=>'delete_post'];
    }

    /**
     * Edit Post
     */
    public function putPost()//TOOD
    {
        return ['action'=>'put_post'];
    }

    /**
     * Get Posts
     */
    public function getPosts()//TODO
    {
        return ['action'=>'get_posts'];
    }

    /**
     * Get Suggested
     */
    public function getSuggestions()//TODO
    {
        return ['action'=>'get_suggested'];
    }

    /**
     * Insert Newsletter
     */
    public function postNewsletter()//TOOD
    {
        return ['action'=>'post_newsletter'];
    }

    /**
     * Get Newsletter
     */
    public function getNewsletter()//TOOD
    {
        return ['action'=>'get_newsletter'];
    }

}