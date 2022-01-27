<?php 
namespace TeachStore\Classes\Validation;

class RequiredFile implements ValidationRule
{
    public function check(string $name,$value)
    {
        if($value['error']!=0)
        {
            return "$name must be required";
        }
        return false;
    }

}