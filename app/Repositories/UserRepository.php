<?php

namespace App\Repositories;

use App\Models\User;
use Exception;

class UserRepository
{

    private User $user;

    /**
     * Create a new class instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }


    public function createUser($userData)
    {
        try{

            $user = $this->user::create($userData);
            return $user;

        }catch(Exception $e)
        {
            exception_log("Failed to Insert User", $e);
            return null;
        }
    }
}
