<?php

namespace App\Helpers;

class EmailHelpers
{
    public static function getEmailFromStr($string)
    {
        $pattern = '/[a-z0-9_\-\+\.]+@[a-z0-9\-]+\.([a-z]{2,4})(?:\.[a-z]{2})?/i';
        preg_match_all($pattern, $string, $matches);

        return $matches['0'];
    }

}
