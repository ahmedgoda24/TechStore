<?php
require_once("../app.php");
use TeachStore\Classes\Cart;
use TeachStore\Classes\Validation\Validator;
use TeachStore\Classes\Models\Order;
use TeachStore\Classes\Models\OrderDetails;

$order=new Order;
$orderdetail=new OrderDetails;
$cart=new Cart;
if($request->postHas('submit')and $cart->count()!==0)
{
    $name=$request->post('name');
    $email=$request->post('email');
    $phone=$request->post('phone');
    $address=$request->post('address');
    $validator=new Validator;
    $validator->validate('name',$name,['required','str']);
    if(! empty($email))
    {
        $validator->validate('email',$email,['email','str']);
       
    }else{
        $email="NULL";

    }
    $validator->validate('phone',$phone,['required','str']);
    if(!empty($address))
    {
        $validator->validate('address',$address,['str']);
        

    }else{
        $address="NULL";
    }
    if($validator->hasError()){
        $session->set('errors',$validator->getError());
        $request->redirect('cart.php');
    }else{
        $order=new Order;
       $orderId= $order->insertAndGetId("name,email,phone,address","'$name','$email','$phone','$address'");
        foreach($cart->all() as $prodID=>$prodData){
            $qunt=$prodData['qunt'];
            $orderdetail->insert("order_id,product_id,quan","'$orderId','$prodID','$qunt'");
        }
        $cart->empty();
         $request->redirect("products.php");

        

    }


}else{
    $request->redirect("products.php");

}