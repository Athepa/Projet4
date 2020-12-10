<?php

declare(strict_types=1);

namespace App\View;

class View
{
    public function render(array $data): void
    {
        ob_start();
        require_once "..\\templates\\frontoffice\\${data['template']}.html.php";
        $content = ob_get_clean();
        require_once '..\templates\frontoffice\layout.html.php';
    }

    public function renderBackOffice(array $data): void
    {
        ob_start();
        require_once "..\\templates\\backoffice\\${data['template']}.html.php";
        $content = ob_get_clean();
        require_once '..\templates\backoffice\layoutBackoffice.html.php';
    }
}
