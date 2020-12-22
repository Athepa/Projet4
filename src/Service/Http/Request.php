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
    
    public function getPost(): ?array
    {
        return count($this->post) === 0 ? null : $this->post;
    }

    public function getAction(): string
    {
        return (string)$this->get['action'];
    }

    public function getPage(): int
    {
        return (int)$this->get['page'];
    }

    public function getIdPost(): int
    {
        return (int)$this->get['idPost'];
    }

    public function getIdComment(): int
    {
        return (int)$this->get['idComment'];
    }

    public function getIdAuthor(): int
    {
        return(int)$this->get['idAuthor'];
    }
}
// class permettant la gestion des variables supers globales de php sauf $_SESSION
