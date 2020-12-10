<?php

declare(strict_types=1);

namespace  App\Controller\Backoffice;

use App\View\View;

class AuthorAddPostController
{
    private View $view;

    public function __construct(View $view)
    {
        $this->view = $view;
    }

    public function authorAddPostDisplay(): void
    {
        $this->view->renderBackOffice(['template' => 'authorAddPost']);
    }
}
