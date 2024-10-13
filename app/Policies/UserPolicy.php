<?php

namespace App\Policies;


use App\Models\User;
use App\Policies\UserPolicy;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    // Memeriksa apakah admin dapat melihat semua pengguna
    public function viewAny(User $user)
    {
        return $user->role === 'admin'; // Hanya admin yang dapat melihat semua pengguna
    }

   // Memeriksa apakah admin dapat menambah pengguna baru
    public function create(User $user)
    {
        return $user->role === 'admin'; // Hanya admin yang dapat menambah pengguna
    }

    // Memeriksa apakah pengguna dapat memperbarui data
    public function update(User $user, User $model)
    {
        return $user->id === $model->id || $user->role === 'admin'; // Pengguna dapat mengupdate dirinya sendiri atau admin
    }

    // Memeriksa apakah pengguna dapat menghapus data
    public function delete(User $user, User $model)
    {
        return $user->role === 'admin' || $user->id === $model->id; // Admin dapat menghapus pengguna lain, pengguna biasa hanya dapat menghapus dirinya sendiri
    }

        // Memeriksa apakah admin dapat melihat detail pengguna berdasarkan ID
    public function view(User $user, User $model)
    {
        return $user->role === 'admin'; // Hanya admin yang dapat melihat detail pengguna
    }


    
}