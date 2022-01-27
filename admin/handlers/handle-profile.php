<?php
require_once("../../app.php");

use TeachStore\Classes\Models\Admin;
use TeachStore\Classes\Validation\Validator;



if($request->postHas('submit'))
{
    $name=$request->post('name');
    $email=$request->post('email');
    $password=$request->post('password');
    $confirm_password=$request->post('confirm_password');

    $validator=new Validator;
   
  
        $validator->validate('name',$name,['required','str']);
        $validator->validate('email',$email,['required','email','str']);
        if(!empty($password)and !$password==$confirm_password){
            $validator->validate('password',$password,['required','str']);

        }

    

    if($validator->hasError()){
        $session->set('errors',$validator->getError());
        $request->aredirect('profile.php');
    }else{
        $admin=new Admin;
       
        if(! empty($password)){
            // update query with password
            $hashedPassword=password_hash($password,PASSWORD_DEFAULT);
            $admin->update("name='$name',email='$email',password='$hashedPassword'",$session->get('adminID'));
            
        }else{
            // update query without password
            $admin->update("name='$name',email='$email'",$session->get('adminID'));

        }
        $session->set('success','profile edit successfully');
        $request->aredirect('handlers/handle-logout.php');

    }


}else{
    $request->aredirect('login.php');


}