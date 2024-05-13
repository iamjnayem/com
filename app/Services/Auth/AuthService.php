<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Repositories\UserRepository;
use Exception;

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
            error_log("Failed to create User in register service", $e);
            return null;
        }
    }
}
