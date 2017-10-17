<?php

namespace Tech387\Models\Mappers;

use PDO;
use PDOException;
use Tech387\Core\Component\DataMapper;
use Tech387\Models\Entities;

class BlogMapper extends DataMapper
{

    /**
     * Get Post
     */
    public function getPost(Entities\Blog $blog)//TODO
    {
        $sql = "";
        $statement = $this->connection->prepare($sql);
        $statement->execute();
        $data = $statement->fetch(PDO::FETCH_ASSOC);

        $blog->setResponse($data);
    }

    /**
     * Get Posts
     */
    public function getPosts(Entities\Blog $blog)//TODO
    {
        $sql = "";
        $statement = $this->connection->prepare($sql);
        $statement->execute();
        $data = $statement->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Insert Post
     */
    public function insertPost(Entities\Blog $blog)//TODO
    {
        $sql = "";
        $statement = $this->connection->prepare($sql);
        $statement->execute();
        $data = $statement->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Delete Post
     */
    public function deletePost(Entities\Blog $blog)//TOOD
    {
        $sql = "";
        $statement = $this->connection->prepare($sql);
        $statement->execute();
        $data = $statement->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Edit Post
     */
    public function editPost(Entities\Blog $blog)//TOOD
    {
        $sql = "";
        $statement = $this->connection->prepare($sql);
        $statement->execute();
        $data = $statement->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Get Suggested Posts
     */
    public function getSuggestions(Entities\Blog $blog)//TODO
    {
        $sql = "";
        $statement = $this->connection->prepare($sql);
        $statement->execute();
        $data = $statement->fetch(PDO::FETCH_ASSOC);
    }

}