<?php

namespace Tech387\Models\Services;

use Tech387\Models\Mappers;
use Tech387\Core\Mapper\CanCreateMapper;
use Tech387\Models\Entities\Faq;
use Tech387\Models\Entities\Admin;

class FaqService
{

    private $factory;
    
    public function __construct(CanCreateMapper $factory)
    {
        $this->factory = $factory;
    }

    /**
     * Insert Faq
     */
    public function postFaq($question,$answer)
    {
        $faq = new Faq();

        $faq->setQuestion($question);
        $faq->setAnswer($answer);
        
        $mapper = $this->factory->create(\Tech387\Models\Mappers\FaqMapper::class);
        $mapper->insertFaq($faq);
        
        return $faq->getResponse();
    }

    /**
     * Edit Faq
     */
    public function putFaq($id,$question,$answer)
    {
        $faq = new Faq();
        
        $faq->setId($id);
        $faq->setQuestion($question);
        $faq->setAnswer($answer);
        
        $mapper = $this->factory->create(\Tech387\Models\Mappers\FaqMapper::class);
        $mapper->editFaq($faq);
        
        return $faq->getResponse();
    }

    /**
     * Get Faq
     */
    public function getFaq()
    {
        $faq = new Faq();
                
        $mapper = $this->factory->create(\Tech387\Models\Mappers\FaqMapper::class);
        $mapper->getFaq($faq);
        
        return $faq->getResponse();
    }

    /**
     * Delete faq
     */
    public function deleteFaq($id)
    {
        $faq = new Faq();

        $faq->setId($id);
        
        $mapper = $this->factory->create(\Tech387\Models\Mappers\FaqMapper::class);
        $mapper->deleteFaq($faq);
        
        return $faq->getResponse();
    }
    
}