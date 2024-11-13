<?php

namespace App\Helpers;

class NumberHelper
{
    public static function toNepaliNumber($number)
    {
        $englishNumbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $nepaliNumbers = ['०', '१', '२', '३', '४', '५', '६', '७', '८', '९'];

        return str_replace($englishNumbers, $nepaliNumbers, $number);
    }
}
