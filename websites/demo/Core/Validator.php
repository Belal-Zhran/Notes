<?php

namespace Core;

class Validator
{
    #This Method is what we call a Pure Function
    #cause it's dependent on values from outside (clases or objects)
    #best practice to make it Static
    public static function string($value, $min=1, $max= INF)
    {
        $value =trim($value);

        return ( strlen( $value ) >= $min && strlen( $value ) <= $max );
    }

    public static function email($value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }
}