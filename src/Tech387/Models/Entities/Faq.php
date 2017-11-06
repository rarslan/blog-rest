<?php

namespace Tech387\Models\Entities;

class Faq
{
    private $id;
    private $question;
    private $answer;
    private $response;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {   
        return $this->id;
    }   

    public function setQuestion($question)
    {
        $this->question = $question;
    }

    public function getQuestion()
    {
        return $this->question;
    }

    public function setAnswer($answer)
    {
        $this->answer = $answer;
    }

    public function getAnswer()
    {
        return $this->answer;
    }

    public function setResponse($response)
    {
        $this->response = $response;
    }

    public function getResponse()
    {
        return $this->response;
    }

}