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

    public function authorConnectionData(int $index): string
    {
        $dbrequest= $this->database->connectDB()->query('SELECT loginAuthor, authorPassWord
        FROM author');
        $data = $dbrequest->fetch();
        return $data[$index];
    }

    public function authorData(string $loginAuthor): ?array
    {
        $dbrequest= $this->database->connectDB()->prepare('SELECT loginAuthor, authorPassWord FROM `author` WHERE loginAuthor= :loginAuthor');
        $dbrequest->execute([
            'loginAuthor'=> $loginAuthor
        ]);
        $data = $dbrequest->fetch();
        return $data !== false ? $data : null;
    }

    /*public function authorInputData($data): array
    {
        $dbrequest = $this->database->connectDB()->prepare('SELECT loginAuthor, authorPassWord
        FROM  author
        WHERE loginAuthor =:loginAuthorEntered, authorPassWord= :authorPassWordEntered
        ');
        $dbrequest->execute([
            'loginAuthorEntered'=> $data['pseudo-author'],
            'authorPassWordEntered' => $data['pwd-author'],
            ]);

        $result =  $dbrequest->fetchAll();
        return $result;
    }*/
}
