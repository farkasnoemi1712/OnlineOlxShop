<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "database.class.php";

class Products extends Database
{

    // mai adaugi la sfarsit inca un parametru pentru user_id care se salveaza in baza de date
    public function create($category_id, $name, $code, $price, $description, $userId)
    {
        $data = [
            'category_id' => $category_id,
            'name' => $name,
            'code' => $code,
            'price' => $price,
            'description' => $description,
            'userId' => $userId
        ];

        $query = $this->connection->prepare("insert into products (category_id, name, code, price, description, user_id) values (:category_id, :name, :code, :price, :description, :userId)");
        $query->execute($data);
    }

    public function get($id)
    {
        $data = [
            'id' => $id
        ];

        $query = $this->connection->prepare("select * from products where id= :id");
        $query->execute($data);

        return $query->fetch();
    }

    public function getAll($userId)
    {
        if($userId!= null) {//daca e user
            $data = [
                'userId' => $userId
            ];
            $query = $this->connection->prepare("select products.id, products.name, products.price, products.code, categories.name as category_name
                                            from products LEFT JOIN categories on products.category_id = categories.id where user_id= :userId");
            $query->execute($data);

            return $query->fetchAll();

        } else {//pt admin afisam tot
            $query = $this->connection->query("select products.id, products.name, products.price, products.code, categories.name as category_name
                                            from products LEFT JOIN categories on products.category_id = categories.id ");

            return $query->fetchAll();
        }
    }

    public function getAllByCategoryId($id)
    {
        $query = $this->connection->prepare("SELECT 
                                                        products.id,
                                                        products.category_id, 
                                                        products.name,
                                                        products.code,
                                                        products.price,
                                                        products.description,
                                                        product_photos.photo
                                                        FROM products 
                                                        LEFT JOIN product_photos on products.photo_id = product_photos.id
                                                        where products.category_id = :id
                                                        ");
        $query->execute(['id' => $id]);
        return $query->fetchAll();
    }

    public function isMain($id){
        $data = [
            'id' => $id
        ];

        $query =$this->connection->prepare("SELECT photo_id from products where id= :id");
        $query->execute($data);

        return $query->fetch();
    }

    public function getLastSixProducts(){
        $query = $this->connection->query("SELECT 
                                                        products.id,
                                                        products.name, 
                                                        products.price,
                                                        product_photos.photo
                                                        FROM products 
                                                        LEFT JOIN product_photos 
                                                        on products.photo_id = product_photos.id
                                                        ORDER BY id DESC
                                                        LIMIT 12
                                                        ");
        return $query->fetchAll();
    }

    public function setMainPhoto($productId, $photoId){
        $data = [
            'productId' => $productId,
            'photoId' => $photoId
        ];
        $query = $this->connection->prepare("update products set photo_id= :photoId where id= :productId ");
        $query->execute($data);
    }
    public function deleteMainPhoto($id)
    {
        $data = [
            'id' => $id
        ];

        $query = $this->connection->prepare("update products set photo_id= null where id= :id");
        $query->execute($data);
    }

    public function delete($id)
    {
        $data = [
            'id' => $id
        ];

        $query = $this->connection->prepare("delete from products where id= :id");
        $query->execute($data);
    }

    public function update($id, $category_id, $name, $code, $price, $description)
    {
        $data = [
            'id' => $id,
            'category_id' => $category_id,
            'name' => $name,
            'code' => $code,
            'price' => $price,
            'description' => $description
        ];

        $query = $this->connection->prepare("update products set category_id= :category_id, name= :name, code= :code, price= :price, description= :description where id= :id");
        $query->execute($data);
    }
}
