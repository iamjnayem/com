<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Auth\AuthService;
use Exception;
use Illuminate\Http\Request;

use function Laravel\Prompts\error;
use App\Http\Requests\Auth\LoginRequest;

class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;    
    }

    public function register(RegisterRequest $request)
    {
        try
        {
            request_log($request->all(), "Incoming input for Register");
            $result = $this->authService->register($request);

            if($result == null)
            {
                $finalResponse = response()->json(error_response($result, ["user could not created"], 400));
            }
            else
            {
                $finalResponse = response()->json(success_response($result));

            }
            
            response_log($finalResponse, "Final Response from Register");
            return $finalResponse;

        }catch(Exception $e)
        {
            exception_log($e, "Exception occurred during register");
            $finalResponse = error_response(null, ["Something went wrong"]);

            response_log($finalResponse, "Final Response from Register");
            return $finalResponse;
        }
    }

    public function login(LoginRequest $request)
    {
        try
        {
            request_log("Incoming input for Login", $request->all());
            $result = $this->authService->login($request);

            if($result == null)
            {
                $finalResponse = response()->json(error_response($result, ["user couldn't login"], 400));
            }
            else
            {
                $finalResponse = response()->json(success_response($result));

            }
            
            response_log($finalResponse, "Final Response from Login");
            return $finalResponse;

        }catch(Exception $e)
        {
            exception_log($e, "Exception occurred during login");
            $finalResponse = error_response(null, ["Something went wrong"]);

            response_log($finalResponse, "Final Response from Login");
            return $finalResponse;
        }
    }
}
