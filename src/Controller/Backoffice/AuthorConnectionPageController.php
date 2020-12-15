<?php

declare(strict_types=1);

namespace  App\Controller\Backoffice;

use App\View\View;
use App\Service\Http\Request;

class AuthorConnectionPageController
{
    private View $view;
    private Request $request;

    public function __construct(View $view, Request $request)
    {
        $this->view = $view;
        $this->request = $request;
    }

    public function displayAuthorConnectionPage(): void
    {
        if($this->request->getPost() !== null){
            header('location:index.php?action=authorBoard');
            exit;
        }
        $this->view->renderBackOffice(['template' => 'authorConnectionPage']);
    }
}
