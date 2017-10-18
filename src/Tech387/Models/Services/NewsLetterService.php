<?php

namespace Tech387\Models\Services;

use Tech387\Models\Mappers;
use Tech387\Core\Mapper\CanCreateMapper;
use Tech387\Models\Entities\Admin;
use Tech387\Models\Entities\Blog;
use Tech387\Models\Entities\NewsLetter;

class NewsLetterService
{

    private $factory;
    
    public function __construct(CanCreateMapper $factory)
    {
        $this->factory = $factory;
    }

    /**
     * Get Mails
     */
    public function getMails()
    {
        $newsletter = new NewsLetter();
        
        $mapper = $this->factory->create(\Tech387\Models\Mappers\NewsLetterMapper::class);
        $mapper->getMails($newsletter);
        
        return $newsletter->getResponse();
    }

    /**
     * Insert Mails
     */
    public function insertMail($mail)
    {
        $newsletter = new NewsLetter();
        
        $newsletter->setMail($mail);

        $mapper = $this->factory->create(\Tech387\Models\Mappers\NewsLetterMapper::class);
        $mapper->insertMail($newsletter);
        
        return $newsletter->getResponse();
    }
    
}