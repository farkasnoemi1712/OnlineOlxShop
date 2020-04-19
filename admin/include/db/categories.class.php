<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "database.class.php";

class Categories extends Database {

    public function create($name)
    {
        $data = [
            'name' => $name
        ];

        $query = $this->connection->prepare("insert into categories (name) values (:name)");
        $query->execute($data);
    }

    public function get($id)
    {
        $data = [
            'id' => $id
        ];

        $query = $this->connection->prepare("select * from categories where id= :id");
        $query->execute($data);

        return $query->fetch();
    }

    public function getAll()
    {

        $query = $this->connection->query("select * from categories");

        return $query->fetchAll();
    }

    public function delete($id)
    {
        $data = [
            'id' => $id
        ];

        $query = $this->connection->prepare("delete from categories where id= :id");
        $query->execute($data);
    }

    public function update($id, $name)
    {
        $data = [
            'id' => $id,
            'name' => $name
        ];

        $query = $this->connection->prepare("update categories set name= :name where id= :id");
        $query->execute($data);
    }
}