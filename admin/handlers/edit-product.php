<?php
require_once("../../app.php");

use TeachStore\Classes\Validation\Validator;
use TeachStore\Classes\File;
use TeachStore\Classes\Models\Product;

if ($request->postHas('submit')) {
    $id=$request->post('id');
    $name = $request->post('name');
    $cat_id = $request->post('cat_id');
    $price = $request->post('price');
    $pieces = $request->post('pieces');
    $desc = $request->post('desc');
    $img = $request->files("img");

    



    $validator = new Validator;


    $validator->validate('name', $name, ['required', 'str']);
    $validator->validate('cat_id', $cat_id, ['required', 'numeric']);
    $validator->validate('price', $price, ['required', 'numeric']);
    $validator->validate('piecesnumber ', $pieces, ['required', 'numeric']);
    $validator->validate('descreption', $desc, ['required', 'str']);
    if ($img['error'] == 0) {
        $validator->validate('image', $img, ['image']);
    }




    if ($validator->hasError()) {
        $session->set('errors', $validator->getError());
        $request->aredirect('edit-product.php');
    } else {
        $p = new Product;
        $imgName = $p->selectId($id, 'img')['img'];
        if ($img['error'] == 0) {
            unlink(PATH . "uploads/$imgName");

            $file = new File($img);
            $imgName = $file->rename()->upload();
        }
        $p->update("name='$name',`desc`='$desc',price='$price',pieces_no='$pieces',img='$imgName',cat_id='$cat_id'",$id);
        $session->set('success', 'Product Updated Successfully');
        $request->aredirect('products.php');
    }
} else {
    $request->aredirect('edit-product.php');
 }
