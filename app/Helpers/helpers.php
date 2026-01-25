<?php
if (!function_exists('maskEmail')) {
    function maskEmail($email) {
        $parts = explode("@", $email);
        $name = strtolower($parts[0]);
        $domain = $parts[1];
        $first = substr($name, 0, 4);
        return $first . '****@' . $domain;
    }
}


function format_liter($liter, $decimals = 2)
    {
        return number_format($liter, $decimals, ',', '.') . 'L';
    }

     function format_ton($kg, $decimals = 2)
    {
        $ton = $kg / 1000; // 1000 kg = 1 ton
        return number_format($ton, $decimals, ',', '.') . ' Ton';
    }