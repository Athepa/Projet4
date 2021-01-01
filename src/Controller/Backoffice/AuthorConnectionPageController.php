<?php

declare(strict_types=1);

namespace  App\Controller\Backoffice;

use App\Model\AuthorConnectManager;
use App\Service\Http\Request;
use App\View\View;

class AuthorConnectionPageController
{
    private AuthorConnectManager $authorConnectManager;
    private View $view;
    private Request $request;

    public function __construct(AuthorConnectManager $authorConnectManager, View $view, Request $request)
    {
        $this->authorConnectManager =$authorConnectManager;
        $this->view = $view;
        $this->request = $request;
    }

    public function displayAuthorConnectionPage(): void
    {
        if ($this->request->getData() !== null) {
            header('location:index.php?action=authorBoard');
            exit;
        }
        $this->view->render(['template' => 'authorConnectionPage']);
    }

    /*public function authorCheckingDataAction(int $idAuthor, array $data): void
    {
        $getAuthorData = $this->authorConnectManager->authorConnectionData();
        $authorEnteredData = $this->authorConnectManager->authorInputData($idAuthor, $data);
        var_dump($authorEnteredData);

    }*/
}
