<?php

namespace Tech387\Models\Services;

use Tech387\Models\Mappers;
use Tech387\Core\Mapper\CanCreateMapper;
use Tech387\Models\Entities\Admin;
use Tech387\Models\Entities\Blog;

class BlogService
{

    private $factory;

    public function __construct(CanCreateMapper $factory)
    {
        $this->factory = $factory;
    }

    /**
     * Get Post
     */
    public function getPost()//TODO
    {
        $blog = new Blog();

        $mapper = $this->factory->create(\Tech387\Models\Mappers\BlogMapper::class);
        $mapper->getPost($blog);
        
        return $blog->getResponse();
    }

    /**
     * Get Posts
     */
    public function getPosts()//TODO
    {
        $blog = new Blog();
        
        $mapper = $this->factory->create(\Tech387\Models\Mappers\BlogMapper::class);
        $mapper->getPost($blog);
        
        return $blog->getResponse();
    }

    /**
     * Insert Post
     */
    public function insertPost()//TODO
    {
        $blog = new Blog();
        
        $mapper = $this->factory->create(\Tech387\Models\Mappers\BlogMapper::class);
        $mapper->getPost($blog);
        
        return $blog->getResponse();
    }

    /**
     * Delete Post
     */
    public function deletePost()//TODO
    {
        $blog = new Blog();
        
        $mapper = $this->factory->create(\Tech387\Models\Mappers\BlogMapper::class);
        $mapper->getPost($blog);
        
        return $blog->getResponse();
    }

    /**
     * Edit Post
     */
    public function editPost()//TODO
    {
        $blog = new Blog();
        
        $mapper = $this->factory->create(\Tech387\Models\Mappers\BlogMapper::class);
        $mapper->getPost($blog);
        
        return $blog->getResponse();
    }

    /**
     * Get Suggested
     */
    public function getSuggestions()//TODO
    {
        $blog = new Blog();
        
        $mapper = $this->factory->create(\Tech387\Models\Mappers\BlogMapper::class);
        $mapper->getPost($blog);
        
        return $blog->getResponse();
    }

}