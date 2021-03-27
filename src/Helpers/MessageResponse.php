<?php

namespace Theanh\Lararepo\Helpers;

class MessageResponse
{
    public function __construct($status, $data)
    {
        if (!is_array($data)) {
            $data = [$data];
        }
    
        /*return response()->json([
            'status' => $status,
            'data' => $data
        ]);*/
    }
    
    public function success($message, $redirect = null)
    {
        return $this->response([
            'message' => $message,
            'redirect' => $redirect,
        ], true);
    }
    
    public function error($message)
    {
        return $this->response([
            'message' => $message
        ], false);
    }
    
    protected function redirect($redirect)
    {
        return $this->response([
            'redirect' => $redirect,
        ], true);
    }
}