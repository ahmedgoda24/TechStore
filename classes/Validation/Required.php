<?php 
namespace TeachStore\Classes\Validation;

class Required implements ValidationRule
{
    public function check(string $name,$value)
    {
        if(empty($value))
        {
            return "$name must be required";
        }
        return false;
    }

}