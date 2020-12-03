<?php

declare(strict_types=1);

namespace  App\Controller\Frontoffice;

use App\View\View;

class AuthorConnectController
{
    private View $view;

    public function __construct(View $view)
    {
        $this->view = $view;
    }

    public function displayAuthorConnect(): void
    {
        $this->view->render(['template' => 'authorConnect']);
    }
}
