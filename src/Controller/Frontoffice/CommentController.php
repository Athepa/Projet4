<?php

declare(strict_types=1);

namespace  App\Controller\Frontoffice;

use App\Model\CommentManager;


class CommentController
{
    private CommentManager $commentManager;
    

    public function __construct(CommentManager $commentManager) 
    {
       
        $this->commentManager = $commentManager;
        
    }

    public function saveCommentAction(int $idPost, array $data): void
    {
        //mettre en place les règles de gestion des données
        $this->commentManager->addComment($idPost, $data);
        header('location: index.php?action=post&idPost='.$idPost);
        exit();
    }
       
}
