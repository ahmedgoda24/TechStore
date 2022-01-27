<?php

use TeachStore\Classes\Models\Product;

require_once("../../app.php");
if ($request->get('id')) {
    $id = $request->get('id');

    $p = new Product;
    $imgName = $p->selectId($id, 'img')['img'];
    unlink(PATH . "uploads/$imgName");
    $p->delete($id);

    $session->set('success', 'Product deleted Successfully');
    $request->aredirect('products.php');
}
