<?php

declare(strict_types=1);

namespace App\Service;



// class pour gérer la connection à la base de donnée
class Database
{
    public \PDO $database;

    public function __construct()
    {
        $this->database = new \PDO('mysql:host=localhost;dbname=blogdatabase;charset=utf8','root','');
    } 

    public function connectDB(): \PDO 
    {        
        return $this->database;
    }    
}