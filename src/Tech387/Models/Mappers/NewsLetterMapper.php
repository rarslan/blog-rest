<?php

namespace Tech387\Models\Mappers;

use PDO;
use PDOException;
use Tech387\Core\Component\DataMapper;
use Tech387\Models\Entities;

class NewsLetterMapper extends DataMapper
{

    /**
     * Store Mail
     */
    public function insertMail(Entities\NewsLetter $newsLetter)
    {
        $response;
        try{
            $this->connection->beginTransaction();

            $sql = "INSERT INTO newsletter(email) VALUES(?)";
            $statement = $this->connection->prepare($sql);
            $statement->execute(
                [
                    $newsLetter->getMail()
                ]
            );

            $response = ['status'=>200];

            $this->connection->commit();
        }catch(PDOException $e){
            $this->connection->rollback();

            $response = $e->getMessage();
        }
        die(print_r($response));
        $newsLetter->setResponse($response);
    }

    /**
     * Get Mails
     */
    public function getMails(Entities\NewsLetter $newsLetter)
    {
        $response ;
        try{
            $sql = "SELECT email,date FROM newsletter";
            $statement = $this->connection->prepare($sql);
            $statement->execute();
            $newsletters = $statement->fetchAll(PDO::FETCH_ASSOC);
            
            $response = $newsletters;
      
        }catch(PDOException $e){
            $response = $e->getMessage();
        }
        
        $newsLetter->setResponse($response);
    }

}