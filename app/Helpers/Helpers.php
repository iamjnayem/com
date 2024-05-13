<?php 

use Illuminate\Support\Facades\Log;

if(!function_exists('success_response'))
{
    function success_response($data=null, $error=[], $code=200, $message="success")
    {
        return [
            'code'    => $code,
            'message' => $message,
            'error'   => $error,
            'data'    => $data
        ];
    }
}


if(!function_exists('error_response'))
{
    function error_response($data=null, $error=[], $code=500, $message="failed")
    {
        return [
            'code'    => $code,
            'message' => $message,
            'error'   => $error,
            'data'    => $data
        ];
    }
}


if(!function_exists('error_log'))
{
    function error_log($message="", Exception $e)
    {
        Log::error($message);
        Log::error($e->getMessage() . " at " . $e->getLine() . " at " . $e->getFile());
    }
}

if(!function_exists('request_log'))
{
    function request_log($message="", $input)
    {
        Log::info($message . " => " . json_encode($input));
    }
}

if(!function_exists('response_log'))
{
    function response_log($message="", $response)
    {
        Log::info($message . " => " . json_encode($response));
    }
}