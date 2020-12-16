<?php

declare(strict_types=1);

namespace  App\Controller\Backoffice;

use App\View\View;
use App\Model\PostManager;
use App\Service\Http\Request;

class AuthorAddPostController
{
    private View $view;

    public function __construct(View $view ,PostManager $postManager, Request $request)
    {
        $this->view = $view;
        $this->postManager =$postManager;
        $this->request = $request;
    }

    public function authorAddPostDisplay(): void
    {
        $this->view->renderBackOffice(['template' => 'authorAddPost']);
    }

    public function savePostAction( int $idAuthor, $data): void
    {
        if($this->request->getPost()!==null){
            $this->postManager->addPost($idAuthor, $data);
            header('location: index.php?action=authorBoard');
            exit();
        }
    }

}
