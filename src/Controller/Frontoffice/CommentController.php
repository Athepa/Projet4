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
        $this->commentManager->addComment($idPost, $data);
        header('location: index.php?action=post&idPost='.$idPost);
        exit();
    }
    
    public function reportCommentAction(int $idComment): void
    {
        $this->commentManager->reportComment($idComment);
        $idPost = $this->commentManager->findPostId($idComment);
        header('location: index.php?action=post&idPost='.$idPost);
        exit();
    }

    public function deleteCommentAction(int $idComment): void
    {
        $this->commentManager->deleteComment($idComment);
        header('location:index.php?action=reportedCommentsBoard');
        exit();
    }

    public function validateCommentAction(int $idComment): void
    {
        $this->commentManager->validateComment($idComment);
        header('location:index.php?action=reportedCommentsBoard');
        exit();
    }
}
