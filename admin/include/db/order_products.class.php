<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "database.class.php";

class OrderProducts extends Database {

    public function create($product_id, $price, $qty, $order_id)
    {
        $data = [
            'product_id' => $product_id,
            'price' => $price,
            'qty' => $qty,
            'order_id' => $order_id
        ];

        $query = $this->connection->prepare("insert into order_products (product_id, price, qty, order_id) values (:product_id, :price, :qty, :order_id)");
        $query->execute($data);
    }

    public function get($id)
    {
        $data = [
            'id' => $id
        ];

        $query = $this->connection->prepare("select * from order_products where id= :id");
        $query->execute($data);

        return $query->fetch();
    }

    public function getByOrderId($orderId)
    {
        $query = $this->connection->prepare("SELECT 
                                                            order_products.price, 
                                                            order_products.qty, 
                                                            order_products.product_id,
                                                            products.name 
                                                        FROM `order_products` 
                                                        LEFT JOIN products 
                                                        ON order_products.product_id = products.id  
                                                        WHERE order_id = :order_id");
        $query->execute(['order_id' => $orderId]);

        return $query->fetchAll();
    }

    public function delete($id)
    {
        $data = [
            'id' => $id
        ];

        $query = $this->connection->prepare("delete from order_products where id= :id");
        $query->execute($data);
    }

    public function update($id, $product_id, $price, $qty, $order_id)
    {
        $data = [
            'id' => $id,
            'product_id' => $product_id,
            'price' => $price,
            'qty' => $qty,
            'order_id'=> $order_id
        ];

        $query = $this->connection->prepare("update order_products set product_id= :product_id, price= :price, qty= :qty, order_id= :order_id where id= :id");
        $query->execute($data);
    }
}