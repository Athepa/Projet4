<?php

declare(strict_types=1);

namespace App\Service;

class Database
{
    public \PDO $db;

    public function __construct()
    {
        $this->db = new \PDO('mysql:host=localhost;dbname=blogdatabase;charset=utf8','root','');
    } 

    public function connectDB(): \PDO 
    {        
        return $this->db;
    }
    
   
}
    
    

