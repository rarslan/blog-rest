<?php

namespace Tech387\Models\Services;

use Tech387\Models\Mappers;
use Tech387\Models\Entities\Admin;
use Tech387\Core\Mapper\CanCreateMapper;

class AdminService
{
    private $factory;


    public function __construct(CanCreateMapper $factory)
    {
        $this->factory = $factory;
    }

}