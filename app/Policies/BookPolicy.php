<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Book;

class BookPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
	
	public function create(User $user): bool
    {
		//error_log($user->role);
        return $user->role === 'admin';
    }
}
