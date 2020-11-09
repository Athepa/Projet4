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
        $dbrequest = $this->database->connectDB()->prepare('INSERT INTO comments (idPost, pseudoUser, creationDate, commentText) 
        VALUES (:idPost, :pseudoUser, NOW(), :commentText)
        ');
        return $dbrequest->execute([
            'idPost' => $idPost,
            'pseudoUser'=> $data['pseudo'],
            'commentText' => $data['comment']
        ]);
    }

    public function reportComment(int $idComment, array $data) : int
    {
        $dbrequest = $this->database->connectDB()->prepare('UPDATE comments SET report = 1
        WHERE idComment = :idComment
        ');
        $dbrequest->execute(['idComment'=>$idComment]);
        return $data['report'];
    }

    public function validateComment(int $idComment, array $data) : int
    {
        $dbrequest = $this->database->connectDB()->prepare('UPDATE comments SET report = 2
        WHERE idComment = :idComment
        ');
        $dbrequest->execute(['idcomment'=>$idComment]);
        return $data['report'];
    }
}
