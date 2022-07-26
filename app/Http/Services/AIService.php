<?php

namespace App\Http\Services;
use App\Http\Traits\CurlRequest;

class AIService {

    use CurlRequest;

    public function detectViolationFromTextAndImage($body) {
        $url = env('AI_DETECT_URL') . '/check-violation-global-text-imgs';
        $response = $this->curl_post($url, $body);
        return $response;
    }

    public function detectViolationFromUrl($body) {
        $url = env('AI_DETECT_URL') . '/check-violation-global-url';
        $response = $this->curl_post($url, $body);
        return $response;
    }

}