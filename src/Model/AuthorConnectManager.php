<?php

declare(strict_types=1);

namespace App\Model;

use App\Service\Database;

class AuthorConnectManager
{
    private Database $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function authorConnectionData(): array
    {
        $dbrequest= $this->database->connectDB()->query('SELECT idAuthor, loginAuthor, authorFirstName, authorName, authorPassWord
        FROM author');
        $data = $dbrequest->fetchAll();
        return $data;
    }
}
