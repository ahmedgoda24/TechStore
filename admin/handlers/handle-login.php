<?php
require_once("../../app.php");

use TeachStore\Classes\Models\Admin;
use TeachStore\Classes\Validation\Validator;



if($request->postHas('submit'))
{
    $email=$request->post('email');
    $password=$request->post('password');
    $validator=new Validator;
   
  
        $validator->validate('email',$email,['required','email']);
        $validator->validate('password',$password,['required','str']);

    

    if($validator->hasError()){
        $session->set('errors',$validator->getError());
        $request->aredirect('login.php');
    }else{
        $admin=new Admin;
        $isLogin=$admin->login($email,$password,$session);
        if($isLogin){
            $request->aredirect('index.php');
        }else{
            $session->set('errors',['Credential NOT Correct']);
            $request->aredirect('login.php');

        }
    }


}else{
    $request->aredirect('login.php');


}