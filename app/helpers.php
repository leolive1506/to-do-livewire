<?php
if (!function_exists('redirectTo')) {
    function redirectTo($route)
    {
        return redirect()->route($route);
    }
}

if (!function_exists('flashMessage')) {
    function flashMessage($text, $name = 'status')
    {
        request()->session()->flash($name, $text);
    }
}

if (!function_exists('dateFormat')) {
    function dateFormat($date)
    {
        return date('d/m/Y', strtotime($date));
    }
}

if (!function_exists('numberFormat')) {
    function numberFormat($value, $decimal = ',', $thousand = '.')
    {
        if (empty($value)) {
            return $value;
        }

        return number_format($value, 2, $decimal, $thousand);
    }
}

if (!function_exists('getOnlyNumbersDecimal')) {
    function getOnlyNumbersDecimal($string)
    {
        if (empty($string)) {
            return $string;
        }
        $string = str_replace('.', '', $string);
        $string = str_replace(',', '.', $string);

        return intval(floatval($string) * 100);
    }
}

if (!function_exists('isImage')) {
    function isImage($extension)
    {
        if (in_array($extension, ['jpg', 'png', 'jpeg'])) {
            return true;
        }

        return false;
    }
}
