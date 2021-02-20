<?php

declare(strict_types=1);

namespace App\Service;

use App\Service\Http\Session;

class Token
{
    private Session $session;
    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function generate(): string
    {
        $primaryToken = random_bytes(10);
        $hashedToken= password_hash($primaryToken, PASSWORD_BCRYPT);
        $this->session->setTokenKey($hashedToken);
        return $hashedToken;
    }

    public function isValid(string $tokenForm): bool
    {
        return $tokenForm === $this->session->getTokenKey();
    }
}
