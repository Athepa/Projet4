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
        $dbrequest = $this->database->connectDB()->prepare('SELECT idComment,idPost, pseudoUser, DATE_FORMAT(creationDate,\'%d/%m/%Y à %Hh%imin%ss\') AS fr_creationDate, commentText,report  
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

    public function deleteComment(int $idComment): void
    {
        $dbrequest = $this->database->connectDB()->prepare('DELETE FROM comments  WHERE idComment = :idComment');
        $dbrequest->execute(['idComment'=>$idComment]);
    }

    public function findPostId(int $idComment): int
    {
        $dbrequest = $this->database->connectDB()->prepare('SELECT idPost
        FROM comments
        WHERE idComment = :id
        ');

        $dbrequest->execute(['id'=>$idComment]);
        $data = $dbrequest->fetch();
        return (int) $data['idPost'];
    }

    public function reportComment(int $idComment) : void
    {
        $dbrequest = $this->database->connectDB()->prepare('UPDATE comments SET report = 1
        WHERE idComment = :idComment
        ');
        $dbrequest->execute(['idComment'=>$idComment]);
    }

    public function validateComment(int $idComment) : void
    {
        $dbrequest = $this->database->connectDB()->prepare('UPDATE comments SET report = 2
        WHERE idComment = :idComment
        ');
        $dbrequest->execute(['idComment'=>$idComment]);
    }

    public function reportedComments($currentPage, $numberOfCommentsPerPage): ?array
    {
        $limitNb =  ($currentPage -1)* $numberOfCommentsPerPage;
        $dbrequest = $this->database->connectDB()->prepare('SELECT com.idComment,com.idPost, com.pseudoUser, DATE_FORMAT(com.creationDate,\'%d/%m/%Y à %Hh%imin%ss\') AS fr_creationDate, com.commentText,com.report,ep.postorder 
        FROM comments com
        INNER JOIN posts ep ON ep.idPost = com.idPost
        WHERE com.report = 1
        LIMIT :limitNumber, :numberOfCommentsPerPage
        ');

        $dbrequest->bindValue(':numberOfCommentsPerPage', $numberOfCommentsPerPage, \PDO::PARAM_INT);
        $dbrequest->bindValue(':limitNumber', $limitNb, \PDO::PARAM_INT);
        $dbrequest->execute();
        $data = $dbrequest->fetchAll();
        return $data;
    }

    public function countingComments(): int
    {
        $dbrequest = $this->database->connectDB()->query('SELECT count(idComment) FROM comments WHERE report = 1');
        $data = $dbrequest->fetch();
        return (int)$data[0];
    }
}
