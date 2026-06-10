<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Anggota;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnggotaPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Anggota');
    }

    public function view(AuthUser $authUser, Anggota $anggota): bool
    {
        return $authUser->can('View:Anggota');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Anggota');
    }

    public function update(AuthUser $authUser, Anggota $anggota): bool
    {
        return $authUser->can('Update:Anggota');
    }

    public function delete(AuthUser $authUser, Anggota $anggota): bool
    {
        return $authUser->can('Delete:Anggota');
    }

    public function restore(AuthUser $authUser, Anggota $anggota): bool
    {
        return $authUser->can('Restore:Anggota');
    }

    public function forceDelete(AuthUser $authUser, Anggota $anggota): bool
    {
        return $authUser->can('ForceDelete:Anggota');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Anggota');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Anggota');
    }

    public function replicate(AuthUser $authUser, Anggota $anggota): bool
    {
        return $authUser->can('Replicate:Anggota');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Anggota');
    }

}