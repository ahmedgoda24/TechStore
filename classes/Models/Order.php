<?php 
namespace TeachStore\Classes\Models;
use TeachStore\Classes\Db;

class Order extends Db{
    public function __construct()
    {
        $this->table="orders";
        $this->connect();
    }
    public function selectAll(string $fields="*") :array
    { 
        $query="SELECT $fields FROM $this->table
            JOIN order_details JOIN products
            ON $this->table.id=order_details.order_id AND order_details.product_id=products.id
            GROUP BY $this->table.id";
        $result=mysqli_query($this->conn,$query);
        return mysqli_fetch_all($result,MYSQLI_ASSOC);
    }
    public function selectId($id,string $fields="*") 
    { 
        $query="SELECT $fields FROM $this->table JOIN order_details JOIN products
            ON orders.id=order_details.order_id AND order_details.product_id=products.id
            WHERE $this->table.id=$id";
        $result=mysqli_query($this->conn,$query);
        return mysqli_fetch_assoc($result);
    }
}


/*SELECT orders.*,products.name AS prodName ,products.price,order_details.quan  FROM `orders`
JOIN order_details JOIN products
ON orders.id=order_details.order_id AND order_details.product_id=products.id
WHERE orders.id=2; */