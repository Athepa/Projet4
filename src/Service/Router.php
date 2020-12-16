<?php

declare(strict_types=1);

namespace  App\Service;

use App\Controller\Backoffice\AuthorAddPostController;
use App\Controller\Backoffice\AuthorBoardController;
use App\Controller\Backoffice\AuthorConnectionPageController;
use App\Controller\Frontoffice\CommentController;
use App\Controller\Frontoffice\HomeController;
use App\Controller\Frontoffice\PostController;
use App\Model\CommentManager;
use App\Model\PostManager;
use App\Service\Database;
use App\View\View;
use App\Service\Http\Request;

class Router
{
    private Database $database;
    private View $view;
    private array $get;
    private array $post;
    private Request $request;

    public function __construct()
    {
        $this->database = new Database();
        $this->view = new View();
        $this->request = new Request();

        $this->get = $_GET;//While waiting Request Class
        $this->post = $_POST;//While waiting Request Class
    }

    public function run(): void
    {
        $action = isset($this->get['action']) ? $this->get['action'] : 'home';

        if ($action === 'posts') {
            $commentManager = new CommentManager($this->database);
            $postManager = new PostManager($this->database);
            $controller = new PostController($postManager, $commentManager, $this->view);
            //http://index.php?action=posts
            $currentPage = isset($this->get['page'])? $this->get['page'] : 1;
            $controller->displayAllAction((int)$currentPage);
        } elseif ($action === 'post' && isset($this->get['idPost'])) {
            $commentManager = new CommentManager($this->database);
            $postManager = new PostManager($this->database);
            $controller = new PostController($postManager, $commentManager, $this->view);
            //http://index.php?action=post&idPost=X
            $controller->displayOneAction((int)$this->get['idPost']);
        } elseif ($action === 'home') {
            $controller = new HomeController($this->view);
            //http://index.php
            $controller->displayHome();
        } elseif ($action === 'saveComment' && isset($this->get['idPost'])) {
            $commentManager = new CommentManager($this->database);
            $controller = new CommentController($commentManager);
            /*index.php?action=saveComment&idPost=<?=$data['onepost']['idPost']?>*/
            $controller->saveCommentAction((int)$this->get['idPost'], $this->post);
        } elseif ($action=== 'reportComment' && isset($this->get['idComment'])) {
            $commentManager = new CommentManager($this->database);
            $controller = new CommentController($commentManager);
            //http://index.php?action=reportComment&idComment=x
            $controller->reportCommentAction((int)$this->get['idComment']);
        } elseif ($action === 'authorConnectionPage') {
            $controller = new AuthorConnectionPageController($this->view, $this->request);
            //http://index.php?action=authorConnectionPage
            $controller->displayAuthorConnectionPage();
        } elseif ($action === 'authorBoard') {
            $postManager = new PostManager($this->database);
            $commentManager = new CommentManager($this->database);
            $controller = new AuthorBoardController($postManager, $commentManager, $this->view);
            //http://index.php?action=authorBoard
            $controller->displayAuthorBoard();
        } elseif ($action === 'reportedCommentsBoard'){
            $postManager = new PostManager($this->database);
            $commentManager = new CommentManager($this->database);
            $controller = new AuthorBoardController($postManager, $commentManager, $this->view);
            //http://index.php?action=reportedCommentsBoard
            $controller->displayReportedCommentsList();
        } elseif ($action === 'authorAddPost') {
            $postManager = new PostManager($this->database);
            $controller = new AuthorAddPostController($this->view, $postManager, $this->request);
            //http://index.php?action=authorAddPost
            $controller->authorAddPostDisplay();
        } elseif ($action === 'savePost' && isset($this->get['idAuthor'])) {
            $postManager = new PostManager($this->database);
            $controller = new AuthorAddPostController($this->view, $postManager, $this->request);
            //http://index.php?action=savePost&idAuthor=X
            $controller->savePostAction((int)$this->get['idAuthor'],(array)$this->request->getPost());
        } else {
            echo "Error 404 - La page que vous recherchez est indisponible. Veuillez nous excuser pour la gêne occasionnée. <br>
            <a href=http://localhost:8000/index.php>Revenir à la page d'accueil</a>";
        }
    }
}
