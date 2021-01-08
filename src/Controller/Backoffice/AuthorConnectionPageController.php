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

    public function displayAuthorConnectionPage($data): void
    {
        $this->view->render(['template' => 'authorConnectionPage']);

        $storedData = $this->authorConnectManager->authorConnectionData();
        var_dump($storedData);
        die;
        if ($this->request->getData() !== null) {
            header('location:index.php?action=authorBoard');
            exit;
        }
        
        $enteredData = $this->authorConnectManager->authorInputData($data);
        
        
        
        
    }
}
