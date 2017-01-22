<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class Userpolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
        //
    }
    public function update(User $currentUser,User $user){
        return $currentUser->id === $user->id;
    }

    public function destory(User $currentUser,User $user){
        return $currentUser->is_admin && $currentUser->id !== $user->id;
    }

}
