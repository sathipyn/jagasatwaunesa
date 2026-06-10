<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Adopsi;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdopsiPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Adopsi');
    }

    public function view(AuthUser $authUser, Adopsi $adopsi): bool
    {
        return $authUser->can('View:Adopsi');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Adopsi');
    }

    public function update(AuthUser $authUser, Adopsi $adopsi): bool
    {
        return $authUser->can('Update:Adopsi');
    }

    public function delete(AuthUser $authUser, Adopsi $adopsi): bool
    {
        return $authUser->can('Delete:Adopsi');
    }

    public function restore(AuthUser $authUser, Adopsi $adopsi): bool
    {
        return $authUser->can('Restore:Adopsi');
    }

    public function forceDelete(AuthUser $authUser, Adopsi $adopsi): bool
    {
        return $authUser->can('ForceDelete:Adopsi');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Adopsi');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Adopsi');
    }

    public function replicate(AuthUser $authUser, Adopsi $adopsi): bool
    {
        return $authUser->can('Replicate:Adopsi');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Adopsi');
    }

}