<?php

declare(strict_types=1);

namespace  App\Controller\Backoffice;

use App\Service\Http\Request;
use App\View\View;

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
        if ($this->request->getPost() !== null) {
            header('location:index.php?action=authorBoard');
            exit;
        }
        $this->view->render(['template' => 'authorConnectionPage']);
    }
}
