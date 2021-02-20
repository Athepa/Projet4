<?php

declare(strict_types=1);

namespace  App\Controller\Frontoffice;

use App\View\View;

class HomeController
{
    private View $view;

    public function __construct(View $view)
    {
        $this->view = $view;
    }

    public function displayHome(): void
    {
        $this->view->render(['template' => 'home']);
    }

    public function displayErrorPage(): void
    {
        $this->view->render(['template' => 'errorPage']);
    }
}
