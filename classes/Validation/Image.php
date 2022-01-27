<?php 
namespace TeachStore\Classes\Validation;

class Image implements ValidationRule
{
    public function check(string $name,$value)
    {
        $allowedExt=['png','jpg','jpeg','gif'];
        $ext=pathinfo($value['name'],PATHINFO_EXTENSION);
        if(! in_array($ext,$allowedExt))
        {
            return "$name extention is not allowed please, upload png,jpg,jpeg,gif extentions";
        }
        return false;
    }

}