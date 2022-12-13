<?php

namespace App\Helpers;

class StrHelpers
{

    public static function removeStr($removeString, $fromString): array|string
    {
        return str_replace($removeString, "",$fromString);
    }


}
