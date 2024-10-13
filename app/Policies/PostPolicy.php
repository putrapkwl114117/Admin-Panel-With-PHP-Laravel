<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post; // Impor model Post
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


      // Hanya admin yang bisa membuat postingan
    public function create(User $user)
    {
        return $user->role === 'admin';
    }

    // Hanya admin yang bisa mengupdate postingan
    public function update(User $user, Post $post)
    {
        return $user->role === 'admin';
    }

    // Hanya admin yang bisa menghapus postingan
    public function delete(User $user, Post $post)
    {
        return $user->role === 'admin';
    }
}