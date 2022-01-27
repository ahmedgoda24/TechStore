<?php 
namespace TeachStore\Classes\Models;


use TeachStore\Classes\Db;

class OrderDetails extends Db{
    public function __construct()
    {
        $this->table="order_details";
        $this->connect();
    }
    public function selectWithProduct($orderId) 
    { 
        $query="SELECT quan,`name`,price FROM $this->table JOIN products
            ON $this->table.product_id=products.id
            WHERE order_id=$orderId";
        $result=mysqli_query($this->conn,$query);
        return mysqli_fetch_all($result,MYSQLI_ASSOC);

    }
}