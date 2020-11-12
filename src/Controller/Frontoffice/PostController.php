<?php

declare(strict_types=1);

namespace  App\Controller\Frontoffice;

use App\Model\CommentManager;
use App\Model\PostManager;
use App\View\View;

class PostController
{
    private PostManager $postManager;
    private CommentManager $commentManager;
    private View $view;

    public function __construct(PostManager $postManager, CommentManager $commentManager, View $view)
    {
        $this->postManager = $postManager;
        $this->commentManager = $commentManager;
        $this->view = $view;
    }

    public function displayOneAction(int $id): void
    {
        $dataPost = $this->postManager->showOne($id);
        $dataComments = $this->commentManager->showAllFromPost($id);

        if ($dataPost !== null) {
            $this->view->render(['template' => 'post','onepost' => $dataPost, 'comments' => $dataComments]);
        } elseif ($dataPost === null) {
            echo '<h1>faire une redirection vers la page d\'erreur, ce post n\'existe pas</h1><a href="index.php?action=posts">Liste des posts</a><br>';
        }
    }

    public function displayPage(int $id, int $postOrder): void
    {
        $dataPost = $this->postManager->showPage($id, $postOrder);
        $dataComments = $this->commentManager->showAllFromPost($id);

        if ($dataPost !== null) {
            $this->view->render(['template' => 'post','onepost' => $dataPost, 'comments' => $dataComments]);
        } elseif ($dataPost === null) {
            echo '<h1>faire une redirection vers la page d\'erreur, ce post n\'existe pas</h1><a href="index.php?action=posts">Liste des posts</a><br>';
        }
    }



    public function displayAllAction(): void
    {
        $posts = $this->postManager->showAll();

        if ($posts !== null) {
            $this->view->render(['template' => 'posts', 'allposts' => $posts]);
        } elseif ($posts === null) {
            echo '<h1>faire une redirection vers la page d\'erreur, il n\'y pas de post</h1>';
        }
    }
}
