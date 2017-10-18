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
    public function getPost($slug)
    {
        $blog = new Blog();

        $blog->setSlug($slug);

        $mapper = $this->factory->create(\Tech387\Models\Mappers\BlogMapper::class);
        $mapper->getPost($blog);
        
        return $blog->getResponse();
    }

    /**
     * Get Posts
     */
    public function getPosts()
    {
        $blog = new Blog();
        
        $mapper = $this->factory->create(\Tech387\Models\Mappers\BlogMapper::class);
        $mapper->getPosts($blog);
        
        return $blog->getResponse();
    }

    /**
     * Insert Post
     */
    public function insertPost($name,$body,$tags,$images)
    {
        $blog = new Blog();

        $blog->setTitle($name);
        $blog->setSlug(preg_replace('/\s+/', '_', strtolower($name)));
        $blog->setBody($body);
        $blog->setTags($tags);
        $blog->setImages($images);
        
        $mapper = $this->factory->create(\Tech387\Models\Mappers\BlogMapper::class);
        $mapper->insertPost($blog);
        
        return $blog->getResponse();
    }

    /**
     * Delete Post
     */
    public function deletePost($id)
    {
        $blog = new Blog();

        $blog->setId($id);
        
        $mapper = $this->factory->create(\Tech387\Models\Mappers\BlogMapper::class);
        $mapper->deletePost($blog);
        
        return $blog->getResponse();
    }

    /**
     * Edit Post
     */
    public function editPost($id,$name,$body,$tags,$images)
    {
        $blog = new Blog();
        
        $blog->setId($id);
        $blog->setTitle($name);
        $blog->setSlug(preg_replace('/\s+/', '_', strtolower($name)));
        $blog->setBody($body);
        $blog->setTags($tags);
        $blog->setImages($images);

        $mapper = $this->factory->create(\Tech387\Models\Mappers\BlogMapper::class);
        $mapper->editPost($blog);
        
        return $blog->getResponse();
    }

    /**
     * Get Suggested
     */
    public function getSuggestions()
    {
        $blog = new Blog();
        
        $mapper = $this->factory->create(\Tech387\Models\Mappers\BlogMapper::class);
        $mapper->getSuggestions($blog);
        
        return $blog->getResponse();
    }

}