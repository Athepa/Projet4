<?php

declare(strict_types=1);

namespace  App\Service;

use App\Controller\Backoffice\AuthorBoardController;
use App\Controller\Backoffice\AuthorConnectionPageController;
use App\Controller\Frontoffice\CommentController;
use App\Controller\Frontoffice\HomeController;
use App\Controller\Frontoffice\PostController;
use App\Model\AuthorConnectManager;
use App\Model\CommentManager;
use App\Model\PostManager;
use App\Service\Database;
use App\Service\Http\Request;
use App\Service\Http\Session;
use App\View\View;

class Router
{
    private Database $database;
    private View $view;
    private Request $request;

    public function __construct()
    {
        $this->database = new Database();
        $this->view = new View();
        $this->request = new Request();
    }

    public function run(): void
    {
        $action = $this->request->getAction();

        if ($action === 'posts') {
            $commentManager = new CommentManager($this->database);
            $postManager = new PostManager($this->database);
            $controller = new PostController($postManager, $commentManager, $this->view);
            //http://index.php?action=posts
            $currentPage = $this->request->getPage();
            $controller->displayAllAction((int)$currentPage);
        } elseif ($action === 'post') {
            $commentManager = new CommentManager($this->database);
            $postManager = new PostManager($this->database);
            $controller = new PostController($postManager, $commentManager, $this->view);
            //http://index.php?action=post&idPost=X
            $controller->displayOneAction((int)$this->request->getIdPost());
        } elseif ($action === 'home') {
            $controller = new HomeController($this->view);
            //http://index.php
            $controller->displayHome();
        } elseif ($action === 'saveComment') {
            $commentManager = new CommentManager($this->database);
            $controller = new CommentController($commentManager);
            /*index.php?action=saveComment&idPost=<?=$data['onepost']['idPost']?>*/
            $controller->saveCommentAction((int)$this->request->getIdPost(), (array)$this->request->getData());
        } elseif ($action=== 'reportComment') {
            $commentManager = new CommentManager($this->database);
            $controller = new CommentController($commentManager);
            //http://index.php?action=reportComment&idComment=x
            $controller->reportCommentAction((int)$this->request->getIdComment());
        } elseif ($action === 'deleteComment') {
            $commentManager = new CommentManager($this->database);
            $controller = new CommentController($commentManager);
            //index.php?action=deleteComment&idComment=X
            $controller->deleteCommentAction((int)$this->request->getIdComment());
        } elseif ($action === 'validateComment') {
            $commentManager = new CommentManager($this->database);
            $controller = new CommentController($commentManager);
            //index.php?action=validateComment&idComment=X
            $controller->validateCommentAction((int)$this->request->getIdComment());
        } elseif ($action === 'authorConnectionPage') {
            $authorConnectManager = new AuthorConnectManager($this->database);
            $controller = new AuthorConnectionPageController($authorConnectManager, $this->view, $this->request);
            //http://index.php?action=authorConnectionPage
            $controller->displayAuthorConnectionPage($this->request->getData());
        } elseif ($action === 'logout') {
            $authorConnectManager = new AuthorConnectManager($this->database);
            $controller =new AuthorConnectionPageController($authorConnectManager, $this->view, $this->request);
            //http://index.php?action=logout
            $controller->logout();
        } elseif ($action === 'authorBoard') {
            $postManager = new PostManager($this->database);
            $commentManager = new CommentManager($this->database);
            $controller = new AuthorBoardController($postManager, $commentManager, $this->view, $this->request);
            //http://index.php?action=authorBoard
            $currentPage = $this->request->getPage();
            $controller->displayAuthorBoard((int)$currentPage);
        } elseif ($action === 'reportedCommentsBoard') {
            $postManager = new PostManager($this->database);
            $commentManager = new CommentManager($this->database);
            $controller = new AuthorBoardController($postManager, $commentManager, $this->view, $this->request);
            //http://index.php?action=reportedCommentsBoard
            $controller->displayReportedCommentsList();
        } elseif ($action === 'pendingEpisodes') {
            $postManager = new PostManager($this->database);
            $commentManager = new CommentManager($this->database);
            $controller = new AuthorBoardController($postManager, $commentManager, $this->view, $this->request);
            //http://index.php?action=pendingEpisodes
            $currentPage = $this->request->getPage();
            $controller->displayPendingEpisodes($currentPage);
        } elseif ($action === 'authorAddPost') {
            $postManager = new PostManager($this->database);
            $commentManager = new CommentManager($this->database);
            $controller = new AuthorBoardController($postManager, $commentManager, $this->view, $this->request);
            //http://index.php?action=authorAddPost
            $controller->authorAddPostDisplay();
        } elseif ($action === 'savePost' && $this->request->has('idAuthor')) {
            $postManager = new PostManager($this->database);
            $commentManager = new CommentManager($this->database);
            $controller = new AuthorBoardController($postManager, $commentManager, $this->view, $this->request);
            //http://index.php?action=savePost&idAuthor=X
            $controller->savePostAction();
        } elseif ($action === 'deletePost') {
            $postManager = new PostManager($this->database);
            $commentManager = new CommentManager($this->database);
            $controller = new AuthorBoardController($postManager, $commentManager, $this->view, $this->request);
            //http://index.php?action=deletePost&idPost=X
            $controller->deletePostAction((int)$this->request->getIdPost());
        } elseif ($action === 'publishPost') {
            $postManager = new PostManager($this->database);
            $commentManager = new CommentManager($this->database);
            $controller = new AuthorBoardController($postManager, $commentManager, $this->view, $this->request);
            //http://index.php?action=publishPost&idPost=X
            $controller->publishPostAction((int)$this->request->getIdPost());
        } elseif ($action === 'updatingPost') {
            $postManager = new PostManager($this->database);
            $commentManager = new CommentManager($this->database);
            $controller = new AuthorBoardController($postManager, $commentManager, $this->view, $this->request);
            //http://index.php?action=updatingPost&idPost=X
            $controller->updatingPostAction((int)$this->request->getIdPost());
        } elseif ($action === 'updatedPost') {
            $postManager = new PostManager($this->database);
            $commentManager = new CommentManager($this->database);
            $controller = new AuthorBoardController($postManager, $commentManager, $this->view, $this->request);
            //http://index.php?action=updatedPost&idPost=X
            $controller->updatedPostAction((int)$this->request->getIdPost(), (array)$this->request->getData());
        } else {
            echo "Error 404 - La page que vous recherchez est indisponible. Veuillez nous excuser pour la gêne occasionnée. <br>
            <a href=http://localhost:8000/index.php>Revenir à la page d'accueil</a>";
        }
    }
}
