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

        if ($data !== null) {
            $this->view->renderBackOffice(['template' => 'authorBoard', 'allposts' => $data]);
        } elseif ($data === null) {
            echo '<h1>faire une redirection vers la page d\'erreur, il n\'y pas de post</h1>';
        }
    }

    public function displayReportedCommentsList():void
    {
        $dataComments = $this->commentManager->reportedComments();
        $dataPost = $this->postManager->showAllAuthorBoard();

        if ($dataComments !== null) {
            $this->view->renderBackOffice(['template' => 'reportedCommentsBoard', 'allposts' => $dataPost,'comments'=> $dataComments]);
        } elseif ($dataComments === null) {
            echo '<h1>Il n\'y a plus de commentaires signalés. <a href="index.php?action=authorBoard"> Revenir au tableau de bord </a> </h1>';
        }
    }
}
