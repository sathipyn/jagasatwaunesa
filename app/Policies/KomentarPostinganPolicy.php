<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\KomentarPostingan;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\User as AuthUser;

class KomentarPostinganPolicy
{
    use HandlesAuthorization;

    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:KomentarPostingan');
    }

    public function view(AuthUser $authUser, KomentarPostingan $komentarPostingan): bool
    {
        return $authUser->can('View:KomentarPostingan');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:KomentarPostingan');
    }

    public function update(AuthUser $authUser, KomentarPostingan $komentarPostingan): bool
    {
        return $authUser->can('Update:KomentarPostingan');
    }

    public function delete(AuthUser $authUser, KomentarPostingan $komentarPostingan): bool
    {
        return $authUser->can('Delete:KomentarPostingan');
    }

    public function restore(AuthUser $authUser, KomentarPostingan $komentarPostingan): bool
    {
        return $authUser->can('Restore:KomentarPostingan');
    }

    public function forceDelete(AuthUser $authUser, KomentarPostingan $komentarPostingan): bool
    {
        return $authUser->can('ForceDelete:KomentarPostingan');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:KomentarPostingan');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:KomentarPostingan');
    }

    public function replicate(AuthUser $authUser, KomentarPostingan $komentarPostingan): bool
    {
        return $authUser->can('Replicate:KomentarPostingan');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:KomentarPostingan');
    }
}
