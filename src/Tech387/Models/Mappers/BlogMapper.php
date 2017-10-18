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
    public function getPost(Entities\Blog $blog)
    {
        $response;
        try{

            $sql = "SELECT 
                    id,
                    name,
                    slug,
                    body,
                    date
                FROM post
                WHERE slug = ?";
            $statement = $this->connection->prepare($sql);
            $statement->execute(
                [
                    $blog->getSlug()
                ]
            );
            $data = $statement->fetch(PDO::FETCH_ASSOC);

            //Tags
            $sql = "SELECT 
                    name
                FROM tags
                WHERE post_id = ?";
            $statement = $this->connection->prepare($sql);
            $statement->execute(
                [
                    $data['id']
                ]
            );
            $tags = $statement->fetchAll(PDO::FETCH_ASSOC);

            //Images
            $sql = "SELECT 
                    path
                FROM images
                WHERE post_id = ?";
            $statement = $this->connection->prepare($sql);
            $statement->execute(
                [
                    $data['id']
                ]
            );
            $images = $statement->fetchAll(PDO::FETCH_ASSOC);
            
            $response = array_merge($data,["tags"=>$tags,"images"=>$images]);
        }catch(PDOException $e){
            $response = $e->getMessage();
        }

        $blog->setResponse($response);
    }

    /**
     * Get Posts
     */
    public function getPosts(Entities\Blog $blog)
    {
        $response = [];
        try{

            $sql = "SELECT 
                    id,
                    name,
                    slug,
                    body,
                    date
                FROM post";
            $statement = $this->connection->prepare($sql);
            $statement->execute();
            $data = $statement->fetchAll(PDO::FETCH_ASSOC);

            foreach($data as $singleData){
                //Tags
                $sql = "SELECT 
                        name
                    FROM tags
                    WHERE post_id = ?";
                $statement = $this->connection->prepare($sql);
                $statement->execute(
                    [
                        $singleData['id']
                    ]
                );
                $tags = $statement->fetchAll(PDO::FETCH_ASSOC);

                //Images
                $sql = "SELECT 
                        path
                    FROM images
                    WHERE post_id = ?";
                $statement = $this->connection->prepare($sql);
                $statement->execute(
                    [
                        $singleData['id']
                    ]
                );
                $images = $statement->fetchAll(PDO::FETCH_ASSOC);
                
                array_push($response,array_merge($singleData,["tags"=>$tags,"images"=>$images]));
            }

        }catch(PDOException $e){
            $response = $e->getMessage();
        }

        $blog->setResponse($response);
    }

    /**
     * Insert Post
     */
    public function insertPost(Entities\Blog $blog)
    {

        $response;
        try{
            $this->connection->beginTransaction();

            //insert post
            $sql = "INSERT INTO post(name,slug,body) VALUES(?,?,?)";
            $statement = $this->connection->prepare($sql);
            $statement->execute(
                [
                    $blog->getTitle(),
                    $blog->getSlug(),
                    $blog->getBody()
                ]
            );

            $postId = $this->connection->lastInsertId();

            //insert post tags
            $sql = "INSERT INTO tags(post_id,name) VALUES(?,?)";
            foreach($blog->getTags() as $tag){
                $statement = $this->connection->prepare($sql);
                $statement->execute(
                    [
                        $postId,
                        $tag
                    ]
                );
            }
            
            //insert post images
            $sql = "INSERT INTO images(path,post_id) VALUES(?,?)";
            foreach($blog->getImages() as $image){
                $statement = $this->connection->prepare($sql);
                $statement->execute(
                    [
                        $image,
                        $postId
                    ]
                );
            }

            $response = ['status'=>200];

            $this->connection->commit();
        }catch(PDOException $e){
            $this->connection->rollback();

            $response = $e->getMessage();
        }

        $blog->setResponse($response);
    }

    /**
     * Delete Post
     */
    public function deletePost(Entities\Blog $blog)//TOOD
    {
        $response;
        try{
            $this->connection->beginTransaction();

            $sql = "DELETE
                t.*,
                i.*,
                p.*
            FROM post AS p
            INNER JOIN images AS i ON i.post_id = p.id
            INNER JOIN tags AS t ON t.post_id = p.id
            WHERE t.id = ?";
            $statement = $this->connection->prepare($sql);
            $statement->execute(
                [
                    $blog->getId()
                ]
            );

            $data = $statement->fetch(PDO::FETCH_ASSOC);

            $response = ['status'=>200];

            $this->connection->commit();
        }catch(PDOException $e){
            $this->connection->rollback();

            $response = $e->getMessage();
        }

        $blog->setResponse($response);
    }

    /**
     * Edit Post
     */
    public function editPost(Entities\Blog $blog)//TOOD
    {
        $response;
        try{
            $this->connection->beginTransaction();

            $sql = "UPDATE post SET name = ?,body = ? WHERE id = ?";
            $statement = $this->connection->prepare($sql);
            $statement->execute(
                [
                    $blog->getTitle(),
                    $blog->getBody(),
                    $blog->getId()
                ]
            );
        
            //Clear tags
            $sql = "DELETE FROM tags WHERE post_id = ?";
            $statement = $this->connection->prepare($sql);
            $statement->execute(
                [
                    $blog->getId()
                ]
            );
            //Clear images
            $sql = "DELETE FROM images WHERE post_id = ?";
            $statement = $this->connection->prepare($sql);
            $statement->execute(
                [
                    $blog->getId()
                ]
            );

            //Insert tags
            $sql = "INSERT INTO tags(post_id,name) VALUES(?,?)";
            foreach($blog->getTags() as $tag){
                $statement = $this->connection->prepare($sql);
                $statement->execute(
                    [
                        $blog->getId(),
                        $tag
                    ]
                );
            }

            //Insert images
            $sql = "INSERT INTO images(path,post_id) VALUES(?,?)";
            foreach($blog->getImages() as $image){
                $statement = $this->connection->prepare($sql);
                $statement->execute(
                    [
                        $image,
                        $blog->getId()
                    ]
                );
            }

            $response = ['status'=>200];

            $this->connection->commit();
        }catch(PDOException $e){
            $this->connection->rollback();
            
            $response = $e->getMessage();
        }

        $blog->setResponse($response);
    }

    /**
     * Get Suggested Posts
     */
    public function getSuggestions(Entities\Blog $blog)//TODO
    {
        $response;
        try{
            $sql = "";
            $statement = $this->connection->prepare($sql);
            $statement->execute();

            $data = $statement->fetch(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            $response = $e->getMessage();
        }

        $blog->setResponse($data);
    }

}