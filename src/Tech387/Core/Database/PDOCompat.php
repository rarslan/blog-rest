<?php

namespace Tech387\Core\Database;

use PDO;

class PDOCompat extends PDO
{

    private $connection;

    public function __construct()
    {   
        $this->connection = new PDO('mysql:host=localhost;dbname=DiscusApiV2;','root','root');
    }

    public function connect()
    {
        try{
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false );
        }catch(PDOException $e) {  
            return $e->getMessage(); 
        }
        return $this->connection;
    }

}