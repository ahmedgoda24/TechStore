<?php
namespace TeachStore\Classes;

use mysqli;

abstract class Db{

    protected $conn;
    protected $table;
    public function connect(){
        $this->conn=mysqli_connect(DB_SERVERNAME,DB_USERNAME,DB_PASSWORD,DB_NAME);
    }
    public function selectAll(string $fields="*") :array
    { 
        $query="SELECT $fields FROM $this->table";
        $result=mysqli_query($this->conn,$query);
        return mysqli_fetch_all($result,MYSQLI_ASSOC);
    }
    public function selectId($id,string $fields="*") 
    { 
        $query="SELECT $fields FROM $this->table WHERE id=$id";
        $result=mysqli_query($this->conn,$query);
        return mysqli_fetch_assoc($result);
    }
    public function selectWhere($condition,string $fields="*") :array
    { 
        $query="SELECT $fields FROM $this->table WHERE $condition";
        $result=mysqli_query($this->conn,$query);
        return mysqli_fetch_all($result,MYSQLI_ASSOC);

    }
    public function getCount():int
    {
        $query="SELECT COUNT(*) AS CountTable FROM $this->table";
        $result=mysqli_query($this->conn,$query);
        return mysqli_fetch_assoc($result)["CountTable"];

    }
    public function insert(string $fields,string $values):bool
    {
        $query="INSERT INTO $this->table ($fields) VALUES ($values)";
        return mysqli_query($this->conn,$query);
    }
    public function insertAndGetId(string $fields,string $values)
    {
        $query="INSERT INTO $this->table ($fields) VALUES ($values)";
         mysqli_query($this->conn,$query);
         return mysqli_insert_id($this->conn);
    }
    public function update(string $set,$id):bool
    {
        $query="UPDATE $this->table SET $set WHERE id=$id";
        return mysqli_query($this->conn,$query);
    }
    public function delete($id):bool
    {
        $query="DELETE FROM $this->table WHERE id=$id";
        return mysqli_query($this->conn,$query);
    }
}