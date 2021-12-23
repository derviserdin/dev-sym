<?php

namespace App\Service;

class NameGenerator
{
    public function randomName( )
    {
        $names = [
            'Derviş',
            'Üveys',
            'Bilal',
            'Şehmus',
        ];


        $index = array_rand($names);

        return $names[$index];
    }
}