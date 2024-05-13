<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    
    public function register($request)
    {
        try
        {
            $data = $request->validated();
            
            $newUser = $this->userRepository->createUser($data);

            if($newUser != null)
            {
                $token = $newUser->createToken('register')->plainTextToken;
            }

            $finalData = [
                'name' => $newUser->name,
                'email' => $newUser->email
            ];

            $finalData['token'] = $token;

            return $finalData;



        }catch(Exception $e)
        {
            exception_log("Failed to create User in register service", $e);
            return null;
        }
    }

    public function login($request)
    {
        try
        {
            $email = $request->email;
            $password = $request->password;

            if(!Auth::attempt(['email' => $email, 'password' => $password]))
            {
                return null;
            }

            $user = Auth::user();

            $finalData = [
                'name' => $user->name,
                'email' => $user->email
            ];

            $finalData['token'] = $user->createToken('login')->plainTextToken;
            
            return $finalData;
            
        }catch(Exception $e)
        {
            exception_log("Failed to create User in register service", $e);
            return null;
        }
    }
}
