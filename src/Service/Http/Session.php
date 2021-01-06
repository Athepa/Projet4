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

    public function dataSession(): void
    {
        $this->session['AuthorName'];
    }
}    