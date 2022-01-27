<?php

use TeachStore\Classes\Models\Order;

require_once ("../../app.php");
if($request->get('id')){
    $id=$request->get('id');
    $ord=new Order;
    $ord->update("status='canceled'",$id);
    $session->set('success', 'Order Canceled');
        $request->aredirect('orders.php');
}
?>