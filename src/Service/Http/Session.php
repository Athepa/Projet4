<?php

declare(strict_types=1);
// Class permettant de gérer la variable super globale $_SESSION
namespace App\Service\Http;

class Session
{
    public function dataSession(string $element): string
    {
        return $_SESSION[$element] ;
    }

    public function setError(string $message): void
    {
        $_SESSION['error']= $message;
    }

    public function getError()
    {
        $message = $_SESSION['error'];
        session_unset($message);
        return $message;
    }
}
