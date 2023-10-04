<?php

namespace App\Policies;

use App\Models\Thread;
use App\Models\User;

class ThreadPolicy
{
    /**
     * Create a new policy instance.
     */
    //It is always a user compared to another entity.
    public function update(User $user, Thread $thread)
    {
        return $user->id === $thread->user_id;  //true, false
    }
}
