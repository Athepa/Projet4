<?php

declare(strict_types=1);

namespace App\Model;

use App\Service\Database;

class AuthorConnectManager
{
    private Database $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function authorConnectionData(): array
    {
        $dbrequest= $this->database->connectDB()->query('SELECT *
        FROM author');
        $data = $dbrequest->fetchAll();
        return $data;
    }

    public function authorInputData($data): bool
    {
        $dbrequest = $this->database->connectDB()->prepare('INSERT INTO author (loginAuthor, authorPassWord) 
        VALUES (:loginAuthor, :authorPassWord )
        ');
        $dbrequest->execute([            
            'loginAuthor'=> $data['pseudo-author'],
            'authorPassWord' => $data['pwd-author'],            
            ]);    
    }
}
