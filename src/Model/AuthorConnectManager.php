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

    public function connectedAuthor(int $idAuthor, array $data) : bool
    {
        $dbrequest = $this->database->connectDB()->prepare('SELECT idAuthor
        FROM author
        WHERE idAuthor = :idAuthor,
        pseudoAuthor = :loginAuthor AND
        authorPassWord = :authorPassWord
        ');
       return $dbrequest->execute([
            'idAuthor'=>$idAuthor,
            'pseudoAuthor'=>$data['peuso-author'],
            'authorPassWord'=>$data['pwd-author']       
        ]);
    }
}    