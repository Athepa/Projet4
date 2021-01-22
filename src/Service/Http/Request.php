<?php

declare(strict_types=1);

namespace App\Service\Http;

class Request
{
    private $get;
    private $post;

    public function __construct()
    {
        $this->get = $_GET;
        $this->post = $_POST;
    }
    
    public function getData(): ?array
    {
        return count($this->post) === 0 ? null : $this->post;
    }

    public function getAuthorData(string $element): string
    {
        return $this->post[$element];
    }

    public function getAction(): string
    {
        return isset($this->get['action']) ? $this->get['action'] : 'home';
    }

    public function getPage(): int
    {
        return  isset($this->get['page'])? (int) $this->get['page'] : 1;
    }

    public function getIdPost(): int
    {
        return (int) $this->get['idPost'];
    }


    public function getIdComment(): int
    {
        return (int) $this->get['idComment'];
    }

    public function getIdAuthor(): int
    {
        return (int)  $this->get['idAuthor'];
    }

    public function has(string $element): bool
    {
        return isset($this->get[$element]);
    }
}
// class permettant la gestion des variables supers globales de php sauf $_SESSION
