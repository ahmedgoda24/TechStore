<?php
require_once("../../app.php");

use TeachStore\Classes\Validation\Validator;
use TeachStore\Classes\Models\cat;

if($request->postHas('submit'))
{
    $id=$request->post('id');
    $name=$request->post('name');

    


    $validator=new Validator;
   
  
        $validator->validate('name',$name,['required','str']);
       
    

    if($validator->hasError()){
        $session->set('errors',$validator->getError());
        $request->aredirect('add-category.php');
    }else{
        $c=new Cat;
        $c->update("name='$name'",$id);
       
        $session->set('success','category Updated Successfully');
        $request->aredirect('categories.php');

    }


}else{
    $request->aredirect('add-category.php');


}