<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "database.class.php";

class Orders extends Database
{

    public function create($firstname, $lastname, $address, $email, $phone)
    {
        $data = [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'address' => $address,
            'email' => $email,
            'phone' => $phone
        ];

        $query = $this->connection->prepare("insert into orders (firstname, lastname, address, email, phone) values (:firstname, :lastname, :address, :email, :phone)");
        $query->execute($data);

        return $this->connection->lastInsertId();
    }

    public function get($id)
    {
        $data = [
            'id' => $id
        ];

        $query = $this->connection->prepare("select * from orders where id= :id");
        $query->execute($data);

        return $query->fetch();
    }

    public function getAll()
    {
        $query = $this->connection->query("select * from orders");

        return $query->fetchAll();
    }

    public function delete($id)
    {
        $data = [
            'id' => $id
        ];

        $query = $this->connection->prepare("delete from orders where id= :id");
        $query->execute($data);
    }

    public function update($id, $date, $firstname, $lastname, $address, $email, $phone)
    {
        $data = [
            'id' => $id,
            'date' => $date,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'address' => $address,
            'email' => $email,
            'phone' => $phone
        ];

        $query = $this->connection->prepare("update orders set date= :date, firstname= :firstname, lastname= :lastname, address= :address, email= :email, phone= :phone where id= :id");
        $query->execute($data);
    }
}