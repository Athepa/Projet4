<?php

declare(strict_types=1);

namespace App\Model;

use App\Service\Database;

class CommentManager
{
    private Database $database;
    private array $post;
    

    public function __construct(Database $database)
    {
        $this->database = $database;
        $this->post = $_POST;
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

    public function addComment(int $id): ?array
    {
        $idComment = $this->post['id-comment'];
        $pseudoReader = $this->post['pseudo'];
        $commentReader = $this->post['comment'];

        $dbrequest = $this->database->connectDB()->prepare("INSERT INTO comments (idComment, idPost, pseudoUser, creationDate, commentText) 
        VALUES ('$idComment' 'idPost', '$pseudoReader', NOW(), '$commentReader')
        WHERE idPost = :id
        ");
        $dbrequest->execute(['id'=> $id]);
        $data= $request;
        return $data;
    }
}
