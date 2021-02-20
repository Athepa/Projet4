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
        if ($dataPost === null) {
            header('location: index.php?action=error');
            exit;
        }
        $idNext = $this->postManager->nextPost((int) $dataPost['postorder']);
        $idPrev = $this->postManager->previousPost((int) $dataPost['postorder']);
        $dataComments = $this->commentManager->showAllFromPost($id);
        $this->view->render(['template' => 'post','onepost' => $dataPost, 'comments' => $dataComments, 'prevId'=>$idPrev, 'nextId'=>$idNext]);
    }


    public function displayAllAction(int $currentPage): void
    {
        $numberOfPostsPerPage = 4;
        $numberOfPosts = $this->postManager->countingPost();
        $numberOfPages =  (int) ceil($numberOfPosts/$numberOfPostsPerPage);
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

        $posts = $this->postManager->showAllPaginated($currentPage, $numberOfPostsPerPage);

        if ($posts !== null) {
            $this->view->render(['template' => 'posts', 'allposts' => $posts, 'prevPage' => $prevPage, 'nextPage' => $nextPage]);
        } elseif ($posts === null) {
            header('location: index.php?action=error');
            exit;
        }
    }
}
