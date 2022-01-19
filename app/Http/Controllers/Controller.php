<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    public function __construct()
    {
        ini_set('max_execution_time', 120);
    }
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
        $err = curl_error($curl);
        if (!$err){
            try {
                $response = curl_exec($curl);        
                $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                curl_close($curl);
                $res = json_decode($response);
                $collection = collect([$res,$httpcode]);
                //  dd($collection[0]->status);
                //  dd($collection[1]);
                return $collection;    
            } catch (Exception $e) {
                return $e;
            }
        }
        else {
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
        $err = curl_error($curl);
        if (!$err){
            try {
                $response = curl_exec($curl);        
                $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                curl_close($curl);
                $res = json_decode($response);
                $collection = collect([$res,$httpcode]);
                //  dd($collection[0]->status);
                //  dd($collection[1]);
                return $collection;    
            } catch (Exception $e) {
                return $e;
            }
        }
        else {
            return $err;
        }
    }
}
