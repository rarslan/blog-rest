<?php

namespace Tech387\Models\Mappers;

use PDO;
use PDOException;
use Tech387\Core\Component\DataMapper;
use Tech387\Models\Entities;

class FaqMapper extends DataMapper
{
    
    /**
     * Get configuration
     */
    public function getConfiguration()
    {
        return $this->configuration;
    }

    /**
     * Inset Faq
     */
    public function insertFaq(Entities\Faq $faq)
    {
        $response;
        try{
            $this->connection->beginTransaction();

            $sql = "INSERT INTO faq(question,answer) VALUES(?,?)";
            $statement = $this->connection->prepare($sql);
            $statement->execute(
                [
                    $faq->getQuestion(),
                    $faq->getAnswer()
                ]
            );

            $response = ['status'=>200,'message'=>'Successfully inserted'];

            $this->connection->commit();
        }catch(PDOException $e){
            $this->connection->rollback();

            $response = ['status'=>409,'message'=>'Conflict while inserting FAQ'];
        }
        $faq->setResponse($response);
    }

    /**
     * Edit Faq
     */
    public function editFaq(Entities\Faq $faq)
    {
        $response;
        try{
            $sql = "UPDATE faq SET question = ? , answer = ? WHERE id = ?";
            $statement = $this->connection->prepare($sql);
            $statement->execute(
                [
                    $faq->getQuestion(),
                    $faq->getAnswer(),
                    $faq->getId()
                ]
            );

            $response = ['status'=>200,'message'=>'Successfully edited'];
        }catch(PDOException $e){
            $response = ['status'=>409,'message'=>'Conflict while editing FAQ'];
        }
        $faq->setResponse($response);
    }

    /**
     * Get Faqs
     */
    public function getFaq(Entities\Faq $faq)
    {
        $response;
        try{
            $sql = "SELECT * FROM faq ORDER BY id DESC";
            $statement = $this->connection->prepare($sql);
            $statement->execute();
            $data = $statement->fetchAll(PDO::FETCH_ASSOC);

            $response = ['status'=>200,'data'=>$data];
        }catch(PDOException $e){
            $response = ['status'=>409,'message'=>'Conflict while geting FAQ'];
        }
        $faq->setResponse($response);
    }

    /**
     * Delete Faqs
     */
    public function deleteFaq(Entities\Faq $faq)
    {
        $response;
        try{
            $sql = "DELETE FROM faq WHERE id = ?";
            $statement = $this->connection->prepare($sql);
            $statement->execute(
                [
                    $faq->getId()
                ]
            );

            $response = ['status'=>200,'message'=>'Successfully deleted'];
        }catch(PDOException $e){
            $response = ['status'=>409,'message'=>'Conflict while deleting FAQ'];
        }
        $faq->setResponse($response);
    }

}