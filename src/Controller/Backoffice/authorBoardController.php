<?php

declare(strict_types=1);

namespace  App\Controller\Backoffice;

use App\Model\AuthorConnectManager;
use App\Model\CommentManager;
use App\Model\PostManager;
use App\Service\Http\Request;
use App\Service\Http\Session;
use App\View\View;

class AuthorBoardController
{
    private View $view;
    public Session $session;
    public AuthorConnectManager $authorConnectManager;

    public function __construct(PostManager $postManager, CommentManager $commentManager, View $view, Request $request, Session $session)
    {
        $this->postManager = $postManager;
        $this->commentManager = $commentManager;
        $this->view = $view;
        $this->request = $request;
        $this->session = $session;
    }

    public function sessionCheck(): void
    {
        if (empty($this->session->getAuthor('loginAuthor'))) {
            header('Location: index.php?action=authorConnectionPage');
            exit();
        }
    }

    public function displayAuthorBoard($currentPage): void
    {
        $this->sessionCheck();
        $numberOfPostsPerPage = 5;
        $numberOfPosts = $this->postManager->countingPost();
        $numberOfPages =  (int)ceil($numberOfPosts/$numberOfPostsPerPage);
    
        if ($currentPage > $numberOfPages) {
            $currentPage = $numberOfPages;
        } elseif ($currentPage < 1) {
            $currentPage = 1;
        }
        $prevPage = $currentPage -1;
        if ($prevPage<1) {
            $prevPage = null;
        }
        $nextPage = $currentPage + 1;
        if ($nextPage>$numberOfPages) {
            $nextPage = null;
        }

        $data = $this->postManager->showAllPaginated($currentPage, $numberOfPostsPerPage);
        if ($data !== null) {
            $this->view->renderBackOffice(['template' => 'authorBoard', 'allposts' => $data, 'prevPage' => $prevPage, 'nextPage' => $nextPage]);
        } elseif ($data === null) {
            header('Location: index.php?action=authorConnectionPage');
            exit();
        }
    }

    public function displayPendingEpisodes($currentPage): void
    {
        $this->sessionCheck();
        $numberOfPostsPerPage = 5;
        $numberOfPosts = $this->postManager->countingPendingPost();
        $numberOfPages =  (int)ceil($numberOfPosts/$numberOfPostsPerPage);
    
        if ($currentPage > $numberOfPages) {
            $currentPage = $numberOfPages;
        } elseif ($currentPage < 1) {
            $currentPage = 1;
        }
        $prevPage = $currentPage -1;
        if ($prevPage<1) {
            $prevPage = null;
        }
        $nextPage = $currentPage + 1;
        if ($nextPage>$numberOfPages) {
            $nextPage = null;
        }

        $data = $this->postManager->showPendingEpisodes($currentPage, $numberOfPostsPerPage);

        if ($data!== null) {
            $this->view->renderBackOffice(['template'=> 'pendingEpisodes', 'allposts' => $data, 'prevPage' => $prevPage, 'nextPage' => $nextPage]);
        } elseif ($data === null) {
            header('Location: index.php?action=authorConnectionPage');
            exit();
        }
    }

    public function authorAddPostDisplay(): void
    {
        $this->sessionCheck();
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
        $this->sessionCheck();
        $dataToUpdate = $this->postManager->showOne($idPost);
        if ($dataToUpdate !==null) {
            $this->view->renderBackOffice(['template'=>'authorUpdatePost', 'postToUpdate' =>$dataToUpdate]);
        } elseif ($dataToUpdate === null) {
            header('location: index.php?action=authorBoard');
            exit();
        }
    }

    public function updatingPendingPostAction(int $idPost): void
    {
        $this->sessionCheck();
        $dataToUpdate = $this->postManager->showOne($idPost);
        if ($dataToUpdate !==null) {
            $this->view->renderBackOffice(['template'=>'authorUpdatePendingPost', 'postToUpdate' =>$dataToUpdate]);
        } elseif ($dataToUpdate === null) {
            header('location: index.php?action=authorBoard');
            exit();
        }
    }

    public function updatedPendingPostAction(int $idPost, array $data): void
    {
        $data = $this->request->getData();
        $this->postManager->updatedPost($idPost, $data);
        header('location: index.php?action=pendingEpisodes');
        exit();
    }

    public function updatedPublishedPostAction(int $idPost, array $data): void
    {
        $data = $this->request->getData();
        $this->postManager->updatedPost($idPost, $data);
        header('location: index.php?action=authorBoard');
        exit();
    }

    public function displayReportedCommentsList(int $currentPage):void
    {
        $this->sessionCheck();
        $numberOfCommentsPerPage = 4;
        $dataComments = $this->commentManager->reportedComments($currentPage, $numberOfCommentsPerPage);
        $dataPost = $this->postManager->showAllAuthorBoard();

        $numberOfComments = $this->commentManager->countingComments();
        $numberOfPages =  (int)ceil($numberOfComments/$numberOfCommentsPerPage);
        if ($currentPage > $numberOfPages) {
            $currentPage = $numberOfPages;
        } elseif ($currentPage < 1) {
            $currentPage = 1;
        }
        $prevPage = $currentPage -1;
        if ($prevPage<1) {
            $prevPage = null;
        }
        $nextPage = $currentPage + 1;
        if ($nextPage>$numberOfPages) {
            $nextPage = null;
        }

        if ($dataComments !== null) {
            $this->view->renderBackOffice(['template' => 'reportedCommentsBoard', 'allposts' => $dataPost,'comments'=> $dataComments, 'prevPage' => $prevPage, 'nextPage' => $nextPage]);
        } elseif ($dataComments === null) {
            header('location: index.php?action=authorBoard');
            exit();
        }
    }
}
