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
use App\Service\Token;
use App\View\View;

class Router
{
    private Database $database;
    private View $view;
    private Request $request;
    private Token $token;

    public function __construct()
    {
        $this->database = new Database();
        $this->view = new View();
        $this->request = new Request();
        $this->session = new Session();
        $this->token = new Token($this->session);
    }

    public function run(): void
    {
        $action = $this->request->getAction();
        $commentManager = new CommentManager($this->database);
        $postManager = new PostManager($this->database);
        if ($action === 'posts') {
            $controller = new PostController($postManager, $commentManager, $this->view);
            //http://index.php?action=posts
            $currentPage = $this->request->getPage();
            $controller->displayAllAction((int)$currentPage);
        } elseif ($action === 'post') {
            $controller = new PostController($postManager, $commentManager, $this->view);
            //http://index.php?action=post&idPost=X
            $controller->displayOneAction((int)$this->request->getIdPost());
        } elseif ($action === 'home') {
            $controller = new HomeController($this->view);
            //http://index.php
            $controller->displayHome();
        } elseif ($action === 'saveComment') {
            $controller = new CommentController($commentManager);
            /*index.php?action=saveComment&idPost=<?=$data['onepost']['idPost']?>*/
            $controller->saveCommentAction((int)$this->request->getIdPost(), (array)$this->request->getData());
        } elseif ($action=== 'reportComment') {
            $controller = new CommentController($commentManager);
            //http://index.php?action=reportComment&idComment=x
            $controller->reportCommentAction((int)$this->request->getIdComment());
        } elseif ($action === 'deleteComment') {
            $controller = new CommentController($commentManager);
            //index.php?action=deleteComment&idComment=X
            $controller->deleteCommentAction((int)$this->request->getIdComment());
        } elseif ($action === 'validateComment') {
            $controller = new CommentController($commentManager);
            //index.php?action=validateComment&idComment=X
            $controller->validateCommentAction((int)$this->request->getIdComment());
        } elseif ($action === 'authorConnectionPage') {
            $authorConnectManager = new AuthorConnectManager($this->database);
            $controller = new AuthorConnectionPageController($authorConnectManager, $this->view, $this->request, $this->session, $this->token);
            //http://index.php?action=authorConnectionPage
            $controller->displayAuthorConnectionPage($this->request->getData());
        } elseif ($action === 'logout') {
            $authorConnectManager = new AuthorConnectManager($this->database);
            $controller =new AuthorConnectionPageController($authorConnectManager, $this->view, $this->request, $this->session, $this->token);
            //http://index.php?action=logout
            $controller->logout();
        } elseif ($action === 'authorBoard') {
            $controller = new AuthorBoardController($postManager, $commentManager, $this->view, $this->request, $this->session);
            //http://index.php?action=authorBoard
            $currentPage = $this->request->getPage();
            $controller->displayAuthorBoard((int)$currentPage);
        } elseif ($action === 'reportedCommentsBoard') {
            $controller = new AuthorBoardController($postManager, $commentManager, $this->view, $this->request, $this->session);
            //http://index.php?action=reportedCommentsBoard
            $currentPage = $this->request->getPage();
            $controller->displayReportedCommentsList($currentPage);
        } elseif ($action === 'pendingEpisodes') {
            $controller = new AuthorBoardController($postManager, $commentManager, $this->view, $this->request, $this->session);
            //http://index.php?action=pendingEpisodes
            $currentPage = $this->request->getPage();
            $controller->displayPendingEpisodes($currentPage);
        } elseif ($action === 'authorAddPost') {
            $controller = new AuthorBoardController($postManager, $commentManager, $this->view, $this->request, $this->session);
            //http://index.php?action=authorAddPost
            $controller->authorAddPostDisplay();
        } elseif ($action === 'savePost' && $this->request->has('idAuthor')) {
            $controller = new AuthorBoardController($postManager, $commentManager, $this->view, $this->request, $this->session);
            //http://index.php?action=savePost&idAuthor=X
            $controller->savePostAction();
        } elseif ($action === 'deletePost') {
            $controller = new AuthorBoardController($postManager, $commentManager, $this->view, $this->request, $this->session);
            //http://index.php?action=deletePost&idPost=X
            $controller->deletePostAction((int)$this->request->getIdPost());
        } elseif ($action === 'publishPost') {
            $controller = new AuthorBoardController($postManager, $commentManager, $this->view, $this->request, $this->session);
            //http://index.php?action=publishPost&idPost=X
            $controller->publishPostAction((int)$this->request->getIdPost());
        } elseif ($action === 'updatingPost') {
            $controller = new AuthorBoardController($postManager, $commentManager, $this->view, $this->request, $this->session);
            //http://index.php?action=updatingPost&idPost=X
            $controller->updatingPostAction((int)$this->request->getIdPost());
        } elseif ($action === 'updatingPendingPost') {
            $controller = new AuthorBoardController($postManager, $commentManager, $this->view, $this->request, $this->session);
            //http://index.php?action=updatingPendingPost&idPost=X
            $controller->updatingPendingPostAction((int)$this->request->getIdPost());
        } elseif ($action === 'updatedPendingPost') {
            $controller = new AuthorBoardController($postManager, $commentManager, $this->view, $this->request, $this->session);
            //http://index.php?action=updatedPendingPost&idPost=X
            $controller->updatedPendingPostAction((int)$this->request->getIdPost(), (array)$this->request->getData());
        } elseif ($action === 'updatedPublishedPost') {
            $controller = new AuthorBoardController($postManager, $commentManager, $this->view, $this->request, $this->session);
            //http://index.php?action=updatedPublishedPost&idPost=X
            $controller->updatedPublishedPostAction((int)$this->request->getIdPost(), (array)$this->request->getData());
        } else {
            $action === 'error';
            $controller = new HomeController($this->view);
            //http://index.php?action=error
            $controller->displayErrorPage();
        }
    }
}
