<?php


namespace App\Model;


use PDO;

class UserManager extends AbstractManager
{
    const TABLE = 'user';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function userInfos($user): array
    {
        return $this->pdo->query('SELECT * FROM ' . $this->table . ' WHERE id = ' . $user . ';')->fetch();
    }

    public function createUser($userData)
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`name`, `email`, `password`) 
        VALUES (:name, :email, :password)");
        $statement->bindValue('name', $userData['name'], \PDO::PARAM_STR);
        $statement->bindValue('email', $userData['email'], \PDO::PARAM_STR);
        $statement->bindValue('password', $userData['password'], \PDO::PARAM_STR);
        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }

    public function selectOneByName(string $name)
    {
        $statement = $this->pdo->prepare("SELECT * FROM $this->table WHERE name=:name");
        $statement->bindValue('name', $name, \PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetch();
    }

    public function selectOneByEmail(string $email)
    {
        $statement = $this->pdo->prepare("SELECT * FROM $this->table WHERE email=:email");
        $statement->bindValue('email', $email, \PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetch();
    }



    public function selectAdmins() : array
    {
        return $this->pdo->query("SELECT id FROM " . self::TABLE . " WHERE admin = 1;")->fetchAll(PDO::FETCH_ASSOC);
    }


}