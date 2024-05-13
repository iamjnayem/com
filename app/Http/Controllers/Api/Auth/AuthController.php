<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Auth\AuthService;
use Exception;
use Illuminate\Http\Request;

use function Laravel\Prompts\error;

class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;    
    }

    public function register(RegisterRequest $registerRequest)
    {
        try
        {
            request_log("Incoming input for Register", $registerRequest->all());
            $result = $this->authService->register($registerRequest);

            if($result == null)
            {
                $finalResponse = response()->json(error_response($result));
            }
            else
            {
                $finalResponse = response()->json(success_response($result));

            }
            
            response_log("Final Response from Register", $finalResponse);
            return $finalResponse;

        }catch(Exception $e)
        {
            error_log("Exception occurred during register", $e);
            $finalResponse = error_response(null, ["Something went wrong"]);

            response_log("Final Response from Register", $finalResponse);
            return $finalResponse;
        }
    }
}
