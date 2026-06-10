<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Komentar;
use Illuminate\Auth\Access\HandlesAuthorization;

class KomentarPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Komentar');
    }

    public function view(AuthUser $authUser, Komentar $komentar): bool
    {
        return $authUser->can('View:Komentar');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Komentar');
    }

    public function update(AuthUser $authUser, Komentar $komentar): bool
    {
        return $authUser->can('Update:Komentar');
    }

    public function delete(AuthUser $authUser, Komentar $komentar): bool
    {
        return $authUser->can('Delete:Komentar');
    }

    public function restore(AuthUser $authUser, Komentar $komentar): bool
    {
        return $authUser->can('Restore:Komentar');
    }

    public function forceDelete(AuthUser $authUser, Komentar $komentar): bool
    {
        return $authUser->can('ForceDelete:Komentar');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Komentar');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Komentar');
    }

    public function replicate(AuthUser $authUser, Komentar $komentar): bool
    {
        return $authUser->can('Replicate:Komentar');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Komentar');
    }

}