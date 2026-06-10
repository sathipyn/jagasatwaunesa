<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Edukasi;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\User as AuthUser;

class EdukasiPolicy
{
    use HandlesAuthorization;

    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Edukasi');
    }

    public function view(AuthUser $authUser, Edukasi $edukasi): bool
    {
        return $authUser->can('View:Edukasi');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Edukasi');
    }

    public function update(AuthUser $authUser, Edukasi $edukasi): bool
    {
        return $authUser->can('Update:Edukasi');
    }

    public function delete(AuthUser $authUser, Edukasi $edukasi): bool
    {
        return $authUser->can('Delete:Edukasi');
    }

    public function restore(AuthUser $authUser, Edukasi $edukasi): bool
    {
        return $authUser->can('Restore:Edukasi');
    }

    public function forceDelete(AuthUser $authUser, Edukasi $edukasi): bool
    {
        return $authUser->can('ForceDelete:Edukasi');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Edukasi');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Edukasi');
    }

    public function replicate(AuthUser $authUser, Edukasi $edukasi): bool
    {
        return $authUser->can('Replicate:Edukasi');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Edukasi');
    }
}
