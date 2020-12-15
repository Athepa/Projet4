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
}
// class permettant la gestion des variables supers globales de php sauf $_SESSION
