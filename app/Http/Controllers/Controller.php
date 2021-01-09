<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function sendResponse($status, $message, $data = null, $statusCode) 
    {
        return response()->json([
            'status'    =>  $status,
            'message'   =>  $message,
            'data'      =>  $data
        ], $statusCode );
    }

    public function respondWithMessage($status, $message) {
        return response()->json([
            'status'    => $status,
            'message'   => $message,
        ]);
    }
}
