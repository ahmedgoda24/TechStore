<?php


namespace TeachStore\Classes;

class Request{

    public function get(string $key=null)
    {
        return ($key==null)?$_GET:((isset($_GET[$key]))?$_GET[$key]:null);
    }
    public function post(string $key)
    {
        return $_POST[$key];
    }
    public function files(string $key)
    {
        return $_FILES[$key];
    }
    public function postHas(string $key)
    {
        return isset($_POST[$key]);
    }
    public function postClean(string $key)
    {
        return trim(htmlspecialchars($_POST[$key]));
    }
    public function method()
    {
        return $_SERVER["REQUEST_METHOD"];
    }
    public function redirect($path)
    {
        header ("location:".URL.$path);
    }
    public function aredirect($path)
    {
        header ("location:".AURL.$path);
    }
}




?>