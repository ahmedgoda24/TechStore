<?php
namespace TeachStore\Classes\Models;
use TeachStore\Classes\Db;
class Product extends Db{
    public function __construct()
    {
        $this->table="products";
        $this->connect();
    }
    public function selectId($id,string $fields="products.*") 
    { 
        $query="SELECT $fields FROM $this->table JOIN cats
         ON $this->table.cat_id =cats.id
          WHERE $this->table.id=$id";
        $result=mysqli_query($this->conn,$query);
        return mysqli_fetch_assoc($result);
    }
    public function selectAllWithCat(string $fields="*") :array
    { 
        $query="SELECT $fields FROM $this->table JOIN cats
            ON $this->table.cat_id =cats.id";

        $result=mysqli_query($this->conn,$query);
        return mysqli_fetch_all($result,MYSQLI_ASSOC);
    }
}