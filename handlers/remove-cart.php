<?php
require_once("../app.php");
use TeachStore\Classes\Cart;
use TeachStore\Classes\Models\Cat;

if($request->get('id')){
    $id=$request->get('id');
    $cart=new Cart;
    $cart->remove($id);
    $request->redirect("cart.php");
    
}