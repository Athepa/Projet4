<?php

declare(strict_types=1);
// Class permettant de gérer la variable super globale $_SESSION
namespace App\Service\Http;

class Session
{
    public function __construct()
    {
        session_start();
    }

    public function dataSession(string $element): string
    {
        return $_SESSION[$element] ;
    }

    public function setAuthor(string $key, string $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function getAuthor(string $key): ?string
    {
        if (!isset($_SESSION[$key])) {
            return null;
        }
        return $_SESSION[$key] ;
    }

    public function setError(string $value): void
    {
        $_SESSION['error']= $value;
    }

    public function getError(): string
    {
        $message = $_SESSION['error'];
        unset($_SESSION['error']);
        return $message;
    }

    public function setTokenKey( string $value): void
    {
        $_SESSION['token'] = $value;
    }

    public function getTokenKey(): string
    {
        return $_SESSION['token'];
    }
}
