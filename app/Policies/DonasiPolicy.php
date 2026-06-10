<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Donasi;
use Illuminate\Auth\Access\HandlesAuthorization;

class DonasiPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Donasi');
    }

    public function view(AuthUser $authUser, Donasi $donasi): bool
    {
        return $authUser->can('View:Donasi');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Donasi');
    }

    public function update(AuthUser $authUser, Donasi $donasi): bool
    {
        return $authUser->can('Update:Donasi');
    }

    public function delete(AuthUser $authUser, Donasi $donasi): bool
    {
        return $authUser->can('Delete:Donasi');
    }

    public function restore(AuthUser $authUser, Donasi $donasi): bool
    {
        return $authUser->can('Restore:Donasi');
    }

    public function forceDelete(AuthUser $authUser, Donasi $donasi): bool
    {
        return $authUser->can('ForceDelete:Donasi');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Donasi');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Donasi');
    }

    public function replicate(AuthUser $authUser, Donasi $donasi): bool
    {
        return $authUser->can('Replicate:Donasi');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Donasi');
    }

}