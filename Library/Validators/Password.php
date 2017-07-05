<?php

namespace Library\Validators;

class Password {

    public static function isValid($password){
        return (preg_match('/(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[\@\#\$\%]).{8,}$/', $password) == 1 ? true : false);
    }
    
}
