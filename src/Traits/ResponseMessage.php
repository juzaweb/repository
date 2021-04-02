<?php

namespace Theanh\Lararepo\Traits;

trait ResponseMessage
{
    protected function response($data, $status)
    {
        if (!is_array($data)) {
            $data = [$data];
        }
        
        return response()->json([
            'status' => $status,
            'data' => $data
        ]);
    }
    
    protected function success($message, $redirect = null)
    {
        return $this->response([
            'message' => trans($message),
            'redirect' => $redirect,
        ], true);
    }
    
    protected function error($message, $redirect = null)
    {
        return $this->response([
            'message' => trans($message),
            'redirect' => $redirect,
        ], false);
    }
    
    protected function redirect($redirect)
    {
        return $this->response([
            'redirect' => $redirect,
        ], true);
    }
}