<?php

declare(strict_types=1);

namespace App\Model;

use App\Service\Database;

class PostManager
{
    public function __construct(Database $database)
    {
        
    }

   /*public function allPosts()
   {
       $database = $this->connectDB();
       $dbrequest = $database->query('SELECT idPost, idAuthor, DATE_FORMAT(creationDate,\'%d/%m/%Y à %Hh%imin%ss\') AS fr_creationDate, titlePost, textPost 
        FROM posts 
        ORDER BY creationDate DESC LIMIT 0,10');
        return $dbrequest;
   }
   
   public function onePost($id)
   {
        $database = $this->connectDB();
        $dbrequest = $database->prepare('SELECT idPost, idAuthor, DATE_FORMAT(creationDate,\'%d/%m/%Y à %Hh%imin%ss\') AS fr_creationDate, titlePost, textPost
            FROM posts WHERE id=?);
            $dbrequest->execute(array($id));
            $singlePost = $dbrequest->fetch();
            return $singlePost;
   }*/
    private function executeSqlDB(?int $id = null) : ?array
    {
        // *** exemple fictif d'accès à la base de données
        $data = null;
        $postTable = [];
        $postTable['idPost'] = ['idPost' => 'idPost', 'title' => 'titlePost', 'text' => 'textPost'];
        /*$postTable[25] = ['id' => 25, 'title' => 'Article $25 du blog', 'text' => 'Lorem ipsum 25'];*/

        if ($id === null) {
            $data = $postTable;
        } elseif ($id !== null && array_key_exists($id, $postTable)) {
            $data = $postTable[$id];
        }

        return $data;
    }
    
    public function showAll(): ?array
    {
        // renvoie tous les posts
        return $this->executeSqlDB();
    }

    public function showOne(int $id): ?array
    {
        return $this->executeSqlDB($id);
    }
}
