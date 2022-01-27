<?php
namespace TeachStore\Classes\Validation;
interface ValidationRule{
    public function check(string $name,$value);
}