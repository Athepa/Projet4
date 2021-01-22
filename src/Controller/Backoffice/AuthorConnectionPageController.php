<?php

declare(strict_types=1);

namespace  App\Controller\Backoffice;

use App\Model\AuthorConnectManager;
use App\Service\Http\Request;
use App\Service\Http\Session;
use App\View\View;

class AuthorConnectionPageController
{
    private AuthorConnectManager $authorConnectManager;
    private View $view;
    private Request $request;
    public Session $session;

    public function __construct(AuthorConnectManager $authorConnectManager, View $view, Request $request)
    {
        session_start();
        $this->authorConnectManager =$authorConnectManager;
        $this->view = $view;
        $this->request = $request;
    }

    public function displayAuthorConnectionPage(): void
    {
        if ($this->request->getData() !== null) {
            $recuplogAuteur = $this->authorConnectManager->authorData($this->request->getAuthorData('pseudo-author'));
            if ($recuplogAuteur !== null  &&  password_verify($this->request->getAuthorData('pwd-author'), $recuplogAuteur['authorPassWord'])) {
                header('location:index.php?action=authorBoard');
                $_SESSION['loginAuthor']= $recuplogAuteur['loginAuthor'];
                exit;
            }
            $this->view->render(['template' => 'authorConnectionPage']);
                
            echo('L\'dentifiant et/ou le mot de passe sont incorrects. Veuillez réessayer');
        }
        $this->view->render(['template' => 'authorConnectionPage']);
    }

    public function logout(): void
    {
        session_destroy();
        header('Location: index.php?action=authorConnectionPage');
        exit();
    }
}
