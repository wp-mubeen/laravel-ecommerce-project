<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ListPolicy
{
    use HandlesAuthorization;

    public function view(User $user){
         return $user->is_admin;
    }
    public function create(User $user){
        return $user->is_admin;
    }

    public function update(User $user){
        return $user->is_admin;
    }
    public function edit(User $user){
        return $user->is_admin;
    }
    public function delete(User $user){
        return $user->is_admin;
    }
}
