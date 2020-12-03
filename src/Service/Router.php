<?php

declare(strict_types=1);

namespace  App\Service;

use App\Controller\Frontoffice\AuthorConnectController;
use App\Controller\Frontoffice\CommentController;
use App\Controller\Frontoffice\HomeController;
use App\Controller\Frontoffice\PostController;
use App\Model\CommentManager;
use App\Model\PostManager;
use App\Service\Database;
use App\View\View;

class Router
{
    private Database $database;
    private View $view;
    private array $get;
    private array $post;

    public function __construct()
    {
        $this->database = new Database();
        $this->view = new View();

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
            $controller->displayAllAction($currentPage);
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
        }
        elseif ($action === 'AuthorAddPost' && isset($this->get['idAuthor'])){
            $postManager = new PostManager($this->database);
            $commentManager = new CommentManager($this->database);
            $controller = new PostController($postManager, $commentManager, $this->view);
            //index.php?action=AuthorAddPost&idAuthor=X
            $controller->addPostAction((int)$this->get['idAuthor'], $this->post);
        }
        else {
            echo "Error 404 - La page que vous recherchez est indisponible. Veuillez nous excuser pour la gêne occasionnée. <br>
            <a href=http://localhost:8000/?action=posts>Revenir à la liste des épisodes</a>";
        }
    }
}
