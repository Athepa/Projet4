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
        $idNext = $this->postManager->nextPost((int) $dataPost['postorder']);
        $idPrev = $this->postManager->previousPost((int) $dataPost['postorder']);
        $dataComments = $this->commentManager->showAllFromPost($id);

        if ($dataPost !== null) {
            $this->view->render(['template' => 'post','onepost' => $dataPost, 'comments' => $dataComments, 'prevId'=>$idPrev, 'nextId'=>$idNext]);
        } elseif ($dataPost === null) {
            echo '<h1>La page à laquelle vous essayer d\'acéder est indisponible</h1><a href="index.php?action=posts">Retouner à la liste des épisodes</a><br>';
        }
    }


    public function displayAllAction(int $currentPage): void
    {
        $numberOfPostsPerPage = 4;
        $numberOfPosts = $this->postManager->countingPost();
        $numberOfPages =  ceil($numberOfPosts/$numberOfPostsPerPage);
        if ($currentPage > $numberOfPages) {
            $currentPage = $numberOfPages;
        } elseif ($currentPage < 1) {
            $currentPage === 1;
        }
        $prevPage = $currentPage -1;
        if ($prevPage<1) {
            $prevPage = null;
        }
        $nextPage = $currentPage + 1;
        if ($nextPage>$numberOfPages) {
            $nextPage = null;
        }

        $posts = $this->postManager->showAllPaginated($currentPage, $numberOfPostsPerPage);

        if ($posts !== null) {
            $this->view->render(['template' => 'posts', 'allposts' => $posts, 'prevPage' => $prevPage, 'nextPage' => $nextPage]);
        } elseif ($posts === null) {
            echo '<h1>faire une redirection vers la page d\'erreur, il n\'y pas de post</h1>';
        }
    }

    public function addPostAction($idAuthor, $data) : void
    {
        $this->postManager->addPost($idAuthor, $data);        
        //header('location: index.php?action=AuthorAddPost&idAuthor='.$idAuthor);
        //exit();
    }
}
