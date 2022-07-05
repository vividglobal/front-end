<?php

namespace App\Http\Services;

class CapchaService
{
    const GG_VERIFY_URL = 'https://www.google.com/recaptcha/api/siteverify';

    public function verify($token) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => self::GG_VERIFY_URL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => [
                'secret' => env('RECAPTCHA_SECRET_KEY'),
                'response' => $token
            ],
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response, true);

        return isset($response['success']) ? $response['success'] : false;
    }
}