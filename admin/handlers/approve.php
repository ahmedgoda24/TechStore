<?php

use TeachStore\Classes\Models\Order;

require_once ("../../app.php");
if($request->get('id')){
    $id=$request->get('id');
    $ord=new Order;
    $ord->update("status='approved'",$id);
    $session->set('success', 'Order Approved');
        $request->aredirect('order.php?id='.$id);
}
?>