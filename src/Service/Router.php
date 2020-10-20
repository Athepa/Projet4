<?php

declare(strict_types=1);

namespace  App\Service;

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

    public function __construct()
    {
        $this->database = new Database();
        $this->view = new View();

        $this->get = $_GET;//While waiting Request Class
    }

    public function run(): void
    {
        $action = isset($this->get['action']) ? $this->get['action'] : 'home';

        if ($action === 'posts') {
            $commentManager = new CommentManager($this->database);
            $postManager = new PostManager($this->database);
            $controller = new PostController($postManager, $commentManager, $this->view);
            //http://localhost:8000/index.php?action=posts
            $controller->displayAllAction();
        } elseif ($action === 'post' && isset($this->get['idPost'])) {
            $commentManager = new CommentManager($this->database);
            $postManager = new PostManager($this->database);
            $controller = new PostController($postManager, $commentManager, $this->view);
            //http://localhost:8000/index.php?action=post&idPost=2
            $controller->displayOneAction((int)$this->get['idPost']);
        } elseif ($action === 'home') {
            $controller = new HomeController($this->view);
            //http://localhost:8000/index.php
            $controller->displayHome();
        } elseif ($action = 'saveComment' && isset($this->get['idPost']);
            $controller = new PostController ($postManager, $commentManager, $this->view);
            $controller->saveComment($this->post,(int)$this->get['idPost']);
        } else {
            echo "Error 404 - La page que vous recherchez est indisponible. Veuillez nous excuser pour la gêne occasionnée. <br>
            <a href=http://localhost:8000/?action=posts>Revenir à la liste des articles</a>";
        }
    }
}
