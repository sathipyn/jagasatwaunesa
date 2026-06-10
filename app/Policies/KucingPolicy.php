<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Kucing;
use Illuminate\Auth\Access\HandlesAuthorization;

class KucingPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Kucing');
    }

    public function view(AuthUser $authUser, Kucing $kucing): bool
    {
        return $authUser->can('View:Kucing');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Kucing');
    }

    public function update(AuthUser $authUser, Kucing $kucing): bool
    {
        return $authUser->can('Update:Kucing');
    }

    public function delete(AuthUser $authUser, Kucing $kucing): bool
    {
        return $authUser->can('Delete:Kucing');
    }

    public function restore(AuthUser $authUser, Kucing $kucing): bool
    {
        return $authUser->can('Restore:Kucing');
    }

    public function forceDelete(AuthUser $authUser, Kucing $kucing): bool
    {
        return $authUser->can('ForceDelete:Kucing');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Kucing');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Kucing');
    }

    public function replicate(AuthUser $authUser, Kucing $kucing): bool
    {
        return $authUser->can('Replicate:Kucing');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Kucing');
    }

}