<?php

declare(strict_types=1);

namespace  App\Controller\Backoffice;

use App\Model\CommentManager;
use App\Model\PostManager;
use App\Service\Http\Request;
use App\View\View;

class AuthorBoardController
{
    private View $view;

    public function __construct(PostManager $postManager, CommentManager $commentManager, View $view, Request $request)
    {
        $this->postManager = $postManager;
        $this->commentManager = $commentManager;
        $this->view = $view;
        $this->request = $request;
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

    public function displayPendingEpisodes(): void
    {
        $data = $this->postManager->showPendingEpisodes();

        if ($data!== null) {
            $this->view->renderBackOffice(['template'=> 'pendingEpisodes', 'allposts' => $data]);
        } elseif ($data === null) {
            echo '<h1>faire une redirection vers la page d\'erreur, il n\'y pas de post</h1>';
        }
    }

    public function authorAddPostDisplay(): void
    {
        $this->view->renderBackOffice(['template' => 'authorAddPost']);
    }

    public function savePostAction(): void
    {
        if ($this->request->getData()!==null) {
            $this->postManager->addPost($this->request->getIdAuthor(), $this->request->getData());
            header('location: index.php?action=pendingEpisodes');
            exit();
        }
    }

    public function deletePostAction(int $idPost): void
    {
        $this->postManager->deletePost($idPost);
        header('location: index.php?action=authorBoard');
        exit();
    }

    public function publishPostAction(int $idPost): void
    {
        $this->postManager->publishPost($idPost);
        header('location: index.php?action=pendingEpisodes');
        exit();
    }

    public function updatingPostAction(int $idPost): void
    {
        $dataToUpdate = $this->postManager->showOne($idPost);
        if ($dataToUpdate !==null) {
            $this->view->renderBackOffice(['template'=>'authorUpdatePost', 'postToUpdate' =>$dataToUpdate]);
        } elseif ($dataToUpdate === null) {
            echo '<h1>Il n\'y a plus de commentaires signalés. <a href="index.php?action=authorBoard"> Revenir au tableau de bord </a> </h1>';
        }
    }

    public function updatedPostAction(int $idPost, $data): void
    {
       
        $this->postManager->updatedPost($idPost, $data);
        header('location: index.php?action=pendingEpisodes');
        exit();
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
