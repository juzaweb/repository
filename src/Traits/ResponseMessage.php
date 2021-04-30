<?php

namespace Tadcms\Lararepo\Traits;

trait ResponseMessage
{
    protected function response($data, $status)
    {
        if (!is_array($data)) {
            $data = [$data];
        }
    
        if (request()->has('redirect')) {
            $data['redirect'] = request()->input('redirect');
        }
        
        return response()->json([
            'status' => $status,
            'data' => $data
        ]);
    }
    
    protected function success($message)
    {
        return $this->response([
            'message' => $message,
        ], true);
    }
    
    protected function error($message)
    {
        return $this->response([
            'message' => $message,
        ], false);
    }
}