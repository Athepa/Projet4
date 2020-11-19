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
        $dbrequest = $this->database->connectDB()->query('SELECT idPost, idAuthor, DATE_FORMAT(creationDate,\'%d/%m/%Y à %Hh%imin%ss\') AS fr_creationDate, titlePost, textPost, postorder 
        FROM posts 
        ORDER BY postorder LIMIT 0, 4');
        
        $data = $dbrequest->fetchAll();
        return $data;
    }

    public function countingIdPost(): int
    {
        $dbrequest = $this->database->connectDB()->query('SELECT count(IdPost) FROM posts');
        $data = $dbrequest->fetch();
        return (int)$data;
    }

    /*public function postsToShow(): ?array
    {
        $numberOfPosts = 4;
        if(!isset($limit)){
            $limit=0;
        }

        $dbrequest = $this->database->connectDB()->query('SELECT idPost, idAuthor, DATE_FORMAT(creationDate,\'%d/%m/%Y à %Hh%imin%ss\') AS fr_creationDate, titlePost, textPost, postorder
        FROM posts
        ORDER BY postorder DESC LIMIT'.$limit. ','.$numberOfPosts);

        $data = $dbrequest->fetchAll();
    }*/


    

    

    public function showOne(int $id): ?array
    {
        $dbrequest = $this->database->connectDB()->prepare('SELECT idPost, idAuthor, DATE_FORMAT(creationDate,\'%d/%m/%Y à %Hh%imin%ss\') AS fr_creationDate, titlePost, textPost, postorder 
        FROM posts
        WHERE idPost=:id
        ');

        $dbrequest->execute(['id'=>$id]);
        $data = $dbrequest->fetch();
        return $data;
    }

    public function nextPost(int $postorder): ?int
    {
        $dbrequest = $this->database->connectDB()->prepare('SELECT idPost
        FROM posts
        WHERE postorder= (SELECT min(postorder) FROM posts WHERE postorder > :postorder)
        ');

        $dbrequest->execute(['postorder'=>$postorder]);
        $data = $dbrequest->fetch();
        return (int) $data['idPost'];
    }

    public function previousPost(int $postorder): ?int
    {
        $dbrequest = $this->database->connectDB()->prepare('SELECT idPost
        FROM posts
        WHERE postorder= (SELECT max(postorder) FROM posts WHERE postorder < :postorder)
        ');

        $dbrequest->execute(['postorder'=>$postorder]);
        $data = $dbrequest->fetch();
        return (int) $data['idPost'];
    }

    public function addPost(int $idAuthor, array $data): bool
    {
        $dbrequest = $this->database->connectDB()->prepare('INSERT INTO post (idPost, IdAuthor, titlePost, creationDate, textPost, postorder) 
        VALUES (:idAuthor, :titlePost, NOW(), :textPost, :postorder)
        ');
        return $dbrequest->execute([
            'idAuthor' => $idAuthor,
            'titlePost'=> $data['title-post'],
            'textPost' => $data['text-post'],
            'postorder' => $data['post-order']
            ]);
    }

    public function updatePost(int $idPost, array $data) : bool
    {
        $dbrequest = $this->database->connectDB()->prepare('UPDATE posts SET titlePost, textPost
        WHERE idPost = :idPost,
        titlePost = :titlePost,
        textPost = :textPost
        ');
        return $dbrequest->execute(['idPost'=>$idPost,
            'titlePost' => $data['title-post'],
            'textPost' => $data['text-post']
        ]);
    }
}
