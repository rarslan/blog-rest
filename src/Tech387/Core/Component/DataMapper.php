<?php

namespace Tech387\Core\Component;

use PDO;

abstract class DataMapper
{
    protected $connection;

    /**
     * Creates new mapper instance
     *
     * @param PDO $connection
     * 
     * @codeCoverageIgnore
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }
}