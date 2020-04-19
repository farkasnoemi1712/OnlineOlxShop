<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "database.class.php";

class ProductPhotos extends Database
{

    public function create($product_id, $photo)
    {
        $data = [
            'product_id' => $product_id,
            'photo' => $photo
        ];

        $query = $this->connection->prepare("insert into product_photos (product_id, photo) values (:product_id, :photo)");
        $query->execute($data);
    }

    public function get($id)
    {
        $data = [
            'id' => $id
        ];

        $query = $this->connection->prepare("select * from product_photos where product_id= :id");
        $query->execute($data);

        return $query->fetchAll();
    }

    public function getPhoto($id)
    {
        $data = [
            'id' => $id
        ];

        $query = $this->connection->prepare("select photo from product_photos where id= :id");
        $query->execute($data);

        return $query->fetch();
    }

    public function delete($id)
    {
        $data = [
            'id' => $id
        ];

        $query = $this->connection->prepare("delete from product_photos where id= :id");
        $query->execute($data);
    }

    public function getAllByProductId($id)
    {
        $data=[
            'id' => $id
        ];
        $query = $this->connection->prepare("select * from product_photos where product_id= :id");
        $query->execute($data);

        return $query->fetchAll();
    }
}