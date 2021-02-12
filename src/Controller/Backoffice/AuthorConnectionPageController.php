<?php

declare(strict_types=1);

namespace  App\Controller\Backoffice;

use App\Model\AuthorConnectManager;
use App\Service\Http\Request;
use App\Service\Http\Session;
use App\View\View;
use App\Service\Token;

class AuthorConnectionPageController
{
    private AuthorConnectManager $authorConnectManager;
    private View $view;
    private Request $request;
    private Session $session;
    private Token $token;

    public function __construct(AuthorConnectManager $authorConnectManager, View $view, Request $request, Session $session, Token $token)
    {
        $this->authorConnectManager =$authorConnectManager;
        $this->view = $view;
        $this->request = $request;
        $this->session = $session;
        $this->token = $token;
    }

    public function checkConnection(): void
    {
        if ($this->session->getAuthor('loginAuthor')) {
            header('location:index.php?action=authorBoard');
            exit;
        }
    }

    public function displayAuthorConnectionPage(): void
    {
        $this->checkConnection();      
        
        $errorMessage = null;
        if ($this->request->getData() !== null) { 
            $checkValidity = $this->token->isValid($this->request->getAuthorData('token-control'));
            if($checkValidity !== true){
                $this->session->setError('Contrôle invalide!');
                $errorMessage=$this->session->getError();
            } 
            var_dump($errorMessage);
            die;           
            /*var_dump($this->token->isValid($this->request->getAuthorData('token-control')));            
            die;*/
            $recuplogAuteur = $this->authorConnectManager->authorData($this->request->getAuthorData('pseudo-author'));
            if ($recuplogAuteur !== null  &&  password_verify($this->request->getAuthorData('pwd-author'), $recuplogAuteur['authorPassWord'])) {
                $this->session->setAuthor('loginAuthor', $recuplogAuteur['loginAuthor']);
                $this->session->getAuthor('loginAuthor');
                header('location:index.php?action=authorBoard');
                exit;
            }
            $this->session->setError('L\'identifiant et/ou le mot de passe sont incorrects. Veuillez réessayer svp!');
            $errorMessage=$this->session->getError();
        }
        $this->view->render(['template' => 'authorConnectionPage', 'errorMessage' =>$errorMessage, 'token'=>$this->token->generate()]);
    }

    public function logout(): void
    {
        session_destroy();
        header('Location: index.php?action=authorConnectionPage');
        exit();
    }
}
