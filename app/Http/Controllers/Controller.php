<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function sendMessage($number,$message){
        $url = 'https://whatsapp-hobidev.herokuapp.com/send-message';
        $postData="number=$number&message=$message";
        $curl = curl_init();
        curl_setopt_array($curl, array(
                   CURLOPT_URL => $url,
                   CURLOPT_RETURNTRANSFER => true,
                   CURLOPT_ENCODING => "",
                   CURLOPT_MAXREDIRS => 10,
                   CURLOPT_TIMEOUT => 30,
                   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                   CURLOPT_CUSTOMREQUEST => "POST",
                   CURLOPT_POSTFIELDS => $postData,
                   CURLOPT_HTTPHEADER => array(
                       "cache-control: no-cache",
                       "content-type: application/x-www-form-urlencoded"
                   ),
               ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        if (!$err)
        {
            $res = json_decode($response);
            $collection = collect([$res,$httpcode]);
            //  dd($collection[0]->status);
            //  dd($collection[1]);
            return $collection;    
        }else {
            return $err;
        }
    }
    public function sendMedia($number,$caption, $fileUrl){
        $url = 'https://whatsapp-hobidev.herokuapp.com/send-media';
        $postData="number=$number&caption=$caption&file=$fileUrl";
        $curl = curl_init();
        curl_setopt_array($curl, array(
                   CURLOPT_URL => $url,
                   CURLOPT_RETURNTRANSFER => true,
                   CURLOPT_ENCODING => "",
                   CURLOPT_MAXREDIRS => 10,
                   CURLOPT_TIMEOUT => 30,
                   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                   CURLOPT_CUSTOMREQUEST => "POST",
                   CURLOPT_POSTFIELDS => $postData,
                   CURLOPT_HTTPHEADER => array(
                       "cache-control: no-cache",
                       "content-type: application/x-www-form-urlencoded"
                   ),
               ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);   
        if (!$err)
        {
            $res = json_decode($response);
            $collection = collect([$res,$httpcode]);
            //  dd($collection[0]->status);
            //  dd($collection[1]);
            return $collection;    
        }else {
            return $err;
        }
    }
}
