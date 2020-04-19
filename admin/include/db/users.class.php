<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'database.class.php';

class User extends Database{

    public function create($name, $password, $is_admin)
    {
        $passwordHash = sha1($password);

        $data = [
            'name' => $name,
            'password' => $passwordHash,
            'is_admin' => $is_admin
        ];

        $query = $this->connection->prepare("insert into users (name, password, is_admin) values (:name, :password, :is_admin)");
        $query->execute($data);
    }

    public function adminToBe($name, $password)
    {
        $passwordHash = sha1($password);

        $data = [
            'name' => $name,
            'password' => $passwordHash
        ];

        $query = $this->connection->prepare("insert into users (name, password, is_admin) values (:name, :password, 1)");
        $query->execute($data);
    }

    public function getLogin($name, $password)
    {
        $passwordHash = sha1($password);

        $data = [
            'name' => $name,
            'password' => $passwordHash
        ];

        $query = $this->connection->prepare("select * from users where name = :name and  password = :password");
        $query->execute($data);

        return $query->fetch();
    }

    public function updatePassword($id, $password)
    {
        $passwordHash = sha1($password); //ezt tettem hozza

        $data = [
            'id' => $id,
            'password' => $passwordHash
        ];

        $query = $this->connection->prepare("update users set password= :password where id= :id");
        $query->execute($data);
    }
    public function isAdmin($name, $password){
        $passwordHash = sha1($password);

        $data = [
            'name' => $name,
            'password' => $passwordHash
        ];

        $query = $this->connection->prepare("select is_admin from users where name = :name and  password = :password");
        $query->execute($data);

        return $query->fetch();
    }

    public function get($id)
    {
        $data = [
            'id' => $id,
        ];

        $query = $this->connection->prepare("select * from users where id =:id ");
        $query->execute($data);

        return $query->fetch();
    }

    public function getAll()
    {
        $query = $this->connection->query("select * from users");

        return $query->fetchAll();
    }

    public function update($id, $name, $password)
    {
        $passwordHash = sha1($password);

        $data = [
            'id' => $id,
            'name' => $name,
            'password' => $passwordHash
        ];

        $query = $this->connection->prepare("update users set name= :name, password= :password where id= :id");
        $query->execute($data);
    }

    public function updateAll($id, $name, $password, $is_admin)
    {
        $passwordHash = sha1($password);

        $data = [
            'id' => $id,
            'name' => $name,
            'password' => $passwordHash,
            'is_admin' => $is_admin
        ];

        $query = $this->connection->prepare("update users set name= :name, password= :password, is_admin= :is_admin where id= :id");
        $query->execute($data);
    }


    public function delete($id)
    {
        $data = [
            'id'=> $id,
        ];

        $query = $this->connection->prepare("delete from users where id = :id");
        $query->execute($data);
    }
}
//$obj = new User();
//$obj->getLogin('noemi', 'admin');
//print_r($obj);