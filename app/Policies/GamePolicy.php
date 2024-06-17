<?php

namespace App\Policies;

use App\Models\User;

class GamePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->role == 'admin' || $user->role == 'user';
    }

    public function view(User $user)
    {
        return $user->role == 'admin' || $user->role == 'user';
    }

    public function create(User $user): bool
    {
        return $user->role == 'admin' || $user->role == 'user';
    }

    public function edit(User $user)
    {
        return $user->role == 'admin' || $user->role == 'user';
    }

    public function update(User $user): bool
    {
        return $user->role == 'admin' || $user->role == 'user';
    }

    public function destroy(User $user): bool
    {
        return $user->role == 'admin';
    }

    public function search(User $user)
    {
        return $user->role == 'admin' || $user->role == 'user';
    }
}
