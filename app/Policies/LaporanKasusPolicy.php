<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\LaporanKasus;
use Illuminate\Auth\Access\HandlesAuthorization;

class LaporanKasusPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:LaporanKasus');
    }

    public function view(AuthUser $authUser, LaporanKasus $laporanKasus): bool
    {
        return $authUser->can('View:LaporanKasus');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:LaporanKasus');
    }

    public function update(AuthUser $authUser, LaporanKasus $laporanKasus): bool
    {
        return $authUser->can('Update:LaporanKasus');
    }

    public function delete(AuthUser $authUser, LaporanKasus $laporanKasus): bool
    {
        return $authUser->can('Delete:LaporanKasus');
    }

    public function restore(AuthUser $authUser, LaporanKasus $laporanKasus): bool
    {
        return $authUser->can('Restore:LaporanKasus');
    }

    public function forceDelete(AuthUser $authUser, LaporanKasus $laporanKasus): bool
    {
        return $authUser->can('ForceDelete:LaporanKasus');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:LaporanKasus');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:LaporanKasus');
    }

    public function replicate(AuthUser $authUser, LaporanKasus $laporanKasus): bool
    {
        return $authUser->can('Replicate:LaporanKasus');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:LaporanKasus');
    }

}