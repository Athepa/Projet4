<?php

declare(strict_types=1);

namespace  App\Controller\Backoffice;

use App\Model\CommentManager;
use App\Model\PostManager;
use App\View\View;

class AuthorBoardController
{
    private View $view;

    public function __construct(PostManager $postManager, CommentManager $commentManager, View $view)
    {
        $this->postManager = $postManager;
        $this->commentManager = $commentManager;
        $this->view = $view;
    }

    public function displayAuthorBoard(): void
    {
        $data = $this->postManager->showAllAuthorBoard();
        $dataComments = $this->commentManager->reportedComments();

        if ($data !== null) {
            $this->view->renderBackOffice(['template' => 'authorBoard', 'allposts' => $data, 'comments'=> $dataComments]);
        } elseif ($data === null) {
            echo '<h1>faire une redirection vers la page d\'erreur, il n\'y pas de post</h1>';
        }
    }
}
