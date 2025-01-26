<?php

namespace App\Core;

class Validator
{
    public static function validateRequiredFields($data, $requiredFields)
    {
        // Todo 
    }

    public static function validateDateFormat($date)
    {
        // Todo 
    }

    public static function validateNumeric($value)
    {
        // Todo 
    }

    public static function sanitizeString($string)
    {
        return htmlspecialchars(trim($string), ENT_QUOTES, 'UTF-8');
    }


}
