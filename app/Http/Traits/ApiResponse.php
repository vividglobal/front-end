<?php
namespace App\Http\Traits;

trait ApiResponse {
    /**
     * response api
     * @param [object|array] $data
     * @param int statusCode, default 200
     * @param int $success, default true
     */
    protected function response($data = "", $message = "", $statusCode = 200, $success = true) {
        
        if ($statusCode >= 300) {
            $success = false;
        }
        $responseData = [
            'success' => $success,
            'data'    => $data,
            'message' => $message,
        ];
        return \response()->json($responseData, $statusCode);
    }

    public function responseSuccess($data = array(), $message = "", $statusCode = 200) {
        return $this->response($data, $message, $statusCode, true);
    }

    public function responseFail($data = array(), $message = "", $statusCode = 403) {
        return $this->response($data, $message, $statusCode, false);
    }
}