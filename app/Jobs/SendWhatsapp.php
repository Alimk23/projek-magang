<?php

namespace App\Jobs;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendWhatsapp implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $phoneCS;
    protected $msgAdmin;
    public function __construct($phoneCS, $msgAdmin)
    {
        $this->phoneCS = $phoneCS;
        $this->msgAdmin = $msgAdmin;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $url = 'https://whatsapp-hobidev.herokuapp.com/send-message';
        $postData="number=$this->phoneCS&message=$this->msgAdmin";
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
