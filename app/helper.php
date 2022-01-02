<?php

if (!function_exists('currency_format')) {
    function currency_format($number) {
        return number_format($number, 0, ',','.');
    }
}