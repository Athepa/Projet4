<?php

declare(strict_types=1);

namespace App\Model;

use App\Service\Database;

class CommentManager
{
    private Database $database;
    
    

    public function __construct(Database $database)
    {
        $this->database = $database;
        
    }

    public function showAllFromPost(int $id): ?array
    {
        $dbrequest = $this->database->connectDB()->prepare('SELECT idComment,idPost, pseudoUser, DATE_FORMAT(creationDate,\'%d/%m/%Y à %Hh%imin%ss\') AS fr_creationDate, commentText  
        FROM comments
        WHERE idPost=:id
        ');

        $dbrequest->execute(['id'=>$id]);
        $data = $dbrequest->fetchAll();
        return $data;
    }

    public function addComment(int $idPost, array $data): bool
    {
        $dbrequest = $this->database->connectDB()->prepare("INSERT INTO comments (idPost, pseudoUser, creationDate, commentText) 
        VALUES (':idPost', ':pseudoUser', NOW(), ':commentText')
        ");
        $this->database->connectDB()->errorInfo();
        return $dbrequest->execute([
            'idPost' => $idPost,
            'pseudoUser'=> $data['pseudo'],
            'commentText' => $data['comment']
        ]);   
        
    }
}
