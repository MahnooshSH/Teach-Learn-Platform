<?php

namespace App\Policies;

use App\User;
use App\SharedFile;
use Illuminate\Auth\Access\HandlesAuthorization;

class SharedFilePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the shared file.
     *
     * @param  \App\User  $user
     * @param  \App\SharedFile  $sharedFile
     * @return mixed
     */
    public function view(User $user, SharedFile $sharedFile)
    {
        //
    }

    /**
     * Determine whether the user can create shared files.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the shared file.
     *
     * @param  \App\User  $user
     * @param  \App\SharedFile  $sharedFile
     * @return mixed
     */
    public function update(User $user, SharedFile $sharedFile)
    {
        return $user->id === $sharedFile->user_id;
    }

    /**
     * Determine whether the user can delete the shared file.
     *
     * @param  \App\User  $user
     * @param  \App\SharedFile  $sharedFile
     * @return mixed
     */
    public function delete(User $user, SharedFile $sharedFile)
    {
        return $user->id === $sharedFile->user_id;
    }

    /**
     * Determine whether the user can restore the shared file.
     *
     * @param  \App\User  $user
     * @param  \App\SharedFile  $sharedFile
     * @return mixed
     */
    public function restore(User $user, SharedFile $sharedFile)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the shared file.
     *
     * @param  \App\User  $user
     * @param  \App\SharedFile  $sharedFile
     * @return mixed
     */
    public function forceDelete(User $user, SharedFile $sharedFile)
    {
        //
    }

    public function report(User $user, SharedFile $sharedFile)
    {
        return $user->id != $sharedFile->user_id;
    }
}
