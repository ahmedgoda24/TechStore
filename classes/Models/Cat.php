<?php
namespace TeachStore\Classes\Models;
use TeachStore\Classes\Db;
class Cat extends Db{
    public function __construct()
    {
        $this->table="cats";
        $this->connect();
    }
}