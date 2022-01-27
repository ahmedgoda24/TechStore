<?php
require_once("../../app.php");

use TeachStore\Classes\Validation\Validator;
use TeachStore\Classes\File;
use TeachStore\Classes\Models\Product;

if($request->postHas('submit'))
{
    $name=$request->post('name');
    $cat_id=$request->post('cat_id');
    $price=$request->post('price');
    $pieces=$request->post('pieces');
    $desc=$request->post('desc');
    $img=$request->files("img");



    $validator=new Validator;
   
  
        $validator->validate('name',$name,['required','str']);
        $validator->validate('cat_id',$cat_id,['required','numeric']);
        $validator->validate('price',$price,['required','numeric']);
        $validator->validate('piecesnumber ',$pieces,['required','numeric']);
        $validator->validate('descreption',$desc,['required','str']);

        $validator->validate('image',$img,['requiredfile','image']);

       
    

    if($validator->hasError()){
        $session->set('errors',$validator->getError());
        $request->aredirect('add-product.php');
    }else{
        $file=new File($img);
        $imgUploadName=$file->rename()->upload();
        $p=new Product;
        $p->insert("name,`desc`,price,pieces_no,img,cat_id",
        "'$name','$desc','$price','$pieces','$imgUploadName','$cat_id'");
       
        $session->set('success','Product Added Successfully');
        $request->aredirect('products.php');

    }


}else{
    $request->aredirect('add-product.php');


}