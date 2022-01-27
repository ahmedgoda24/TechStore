<?php
namespace TeachStore\Classes\Validation;

class Validator{
    private $errors=[];
    public function validate($name,$value,array $rules)
    {
        foreach($rules as $rule)
        {
            $className="TeachStore\\Classes\\Validation\\".$rule;
            $obj=new $className;
            $error=$obj->check($name,$value);
            if($error !==false)
            {
                $this->errors[]=$error;
                break;
            }
        }
    }
    public function getError():array
    {
        return $this->errors;
    }
    public function hasError() :bool
    {
        return ! empty( $this->errors);
    }
}