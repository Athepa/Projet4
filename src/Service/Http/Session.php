<?php

declare(strict_types=1);
// Class permettant de gérer la variable super globale $_SESSION
namespace App\Service\Http;


class Session
{
    
    private $session;

    public function __construct()
    {
        $this->session = $_SESSION;
    }

    public function dataSession(string $element): string
    {
        return $this->session[$element] ;
    }

    public function setError(string $message)
    {
        $_SESSION['error']= $message;
    }

    public function getError()
    {
        $message = $_SESSION['error'];
        /*supprimer $_SESSION['error'] */
        return $message;
    }
}    