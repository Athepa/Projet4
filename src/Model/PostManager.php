<?php

declare(strict_types=1);

namespace App\Model;

use App\Service\Database;

class PostManager
{
    private Database $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function showAll() : ?array
    {
        $dbrequest = $this->database->connectDB()->query('SELECT idPost, idAuthor, DATE_FORMAT(creationDate,\'%d/%m/%Y à %Hh%imin%ss\') AS fr_creationDate, titlePost, textPost 
        FROM posts 
        ORDER BY fr_creationDate DESC LIMIT 0,10');
        
        $data = $dbrequest->fetchAll();
        return $data;
    }

    

    public function showOne(int $id): ?array
    {
        $dbrequest = $this->database->connectDB()->prepare('SELECT idPost, idAuthor, DATE_FORMAT(creationDate,\'%d/%m/%Y à %Hh%imin%ss\') AS fr_creationDate, titlePost, textPost 
        FROM posts
        WHERE idPost=:id
        ');

        $dbrequest->execute(['id'=>$id]);
        $data = $dbrequest->fetch();
        return $data;
    }
}
