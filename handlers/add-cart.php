<?php
require_once("../app.php");
use TeachStore\Classes\Cart;

if ($request->postHas('submit')) {
    $id = $request->post('id');
    $qunt = $request->post('qunt');
    $name = $request->post('name');
    $price = $request->post('price');
    $img = $request->post('img');

    $prodData=[
        'qunt'=>$qunt,
        'name'=>$name,
        'price'=>$price,
        'img'=>$img,

    ];    

    $cart=new Cart;
    $cart->Add($id,$prodData);
    
    $request->redirect("products.php");
    
}
