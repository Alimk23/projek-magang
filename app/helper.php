<?php

use App\Models\Profile;
use Illuminate\Support\Facades\Auth;

if (!function_exists('currency_format')) {
    function currency_format($number) {
        return number_format($number, 0, ',','.');
    }
}
if (!function_exists('whatsapp_format')) {
    function whatsapp_format($phone) {
        if (substr(trim($phone), 0, 1)=='0') {
            return '62'.substr(trim($phone), 1);
        }
        else {
            return $phone;
        }
    }
}
if (!function_exists('getProfilePicture')) {
    function getProfilePicture() {
        $profile = new Profile;
        $user = Auth::user();
        $getProfileData = $profile->firstWhere('user_id', $user->id);
        if ($getProfileData) {
            $photo = $getProfileData->photo;
        } 
        else {
            $photo = null;
        }
        return $photo;
    }
}