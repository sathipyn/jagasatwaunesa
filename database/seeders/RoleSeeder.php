<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissionsBySubject = [
            'Anggota' => ['ViewAny', 'View', 'Create', 'Update', 'Delete', 'Restore', 'ForceDelete', 'ForceDeleteAny', 'RestoreAny', 'Replicate', 'Reorder'],
            'Kucing' => ['ViewAny', 'View', 'Create', 'Update', 'Delete', 'Restore', 'ForceDelete', 'ForceDeleteAny', 'RestoreAny', 'Replicate', 'Reorder'],
            'Edukasi' => ['ViewAny', 'View', 'Create', 'Update', 'Delete', 'Restore', 'ForceDelete', 'ForceDeleteAny', 'RestoreAny', 'Replicate', 'Reorder'],
            'Kegiatan' => ['ViewAny', 'View', 'Create', 'Update', 'Delete', 'Restore', 'ForceDelete', 'ForceDeleteAny', 'RestoreAny', 'Replicate', 'Reorder'],
            'LaporanKasus' => ['ViewAny', 'View', 'Create', 'Update', 'Delete', 'Restore', 'ForceDelete', 'ForceDeleteAny', 'RestoreAny', 'Replicate', 'Reorder'],
            'Donasi' => ['ViewAny', 'View', 'Create', 'Update', 'Delete', 'Restore', 'ForceDelete', 'ForceDeleteAny', 'RestoreAny', 'Replicate', 'Reorder'],
            'Adopsi' => ['ViewAny', 'View', 'Create', 'Update', 'Delete', 'Restore', 'ForceDelete', 'ForceDeleteAny', 'RestoreAny', 'Replicate', 'Reorder'],
            'Komentar' => ['ViewAny', 'View', 'Create', 'Update', 'Delete', 'Restore', 'ForceDelete', 'ForceDeleteAny', 'RestoreAny', 'Replicate', 'Reorder'],
            'KomentarPostingan' => ['ViewAny', 'View', 'Create', 'Update', 'Delete', 'Restore', 'ForceDelete', 'ForceDeleteAny', 'RestoreAny', 'Replicate', 'Reorder'],
            'User' => ['ViewAny', 'View', 'Create', 'Update', 'Delete', 'Restore', 'ForceDelete', 'ForceDeleteAny', 'RestoreAny', 'Replicate', 'Reorder'],
            'Role' => ['ViewAny', 'View', 'Create', 'Update', 'Delete', 'Restore', 'ForceDelete', 'ForceDeleteAny', 'RestoreAny', 'Replicate', 'Reorder'],
        ];

        $allPermissions = collect($permissionsBySubject)
            ->flatMap(fn (array $actions, string $subject) => collect($actions)
                ->map(fn (string $action) => "{$action}:{$subject}"))
            ->values();

        foreach ($allPermissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        Permission::query()
            ->where('guard_name', 'web')
            ->whereIn('name', [
                'view_any_anggota', 'view_anggota', 'create_anggota', 'update_anggota', 'delete_anggota', 'delete_any_anggota',
                'view_any_kucing', 'view_kucing', 'create_kucing', 'update_kucing', 'delete_kucing', 'delete_any_kucing',
                'view_any_laporan::kasus', 'view_laporan::kasus', 'create_laporan::kasus', 'update_laporan::kasus', 'delete_laporan::kasus', 'delete_any_laporan::kasus',
                'view_any_donasi', 'view_donasi', 'create_donasi', 'update_donasi', 'delete_donasi', 'delete_any_donasi',
                'view_any_adopsi', 'view_adopsi', 'create_adopsi', 'update_adopsi', 'delete_adopsi', 'delete_any_adopsi',
                'view_any_komentar', 'view_komentar', 'delete_komentar', 'delete_any_komentar',
                'view_any_user', 'view_user', 'delete_user', 'delete_any_user',
                'view_any_role', 'view_role', 'create_role', 'update_role', 'delete_role', 'delete_any_role',
            ])
            ->delete();

        $superAdmin = Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);
        $superAdmin->syncPermissions($allPermissions->all());

        $adminRescue = Role::firstOrCreate(['name' => 'admin_rescue', 'guard_name' => 'web']);
        $adminRescue->syncPermissions([
            'ViewAny:Anggota', 'View:Anggota', 'Create:Anggota', 'Update:Anggota', 'Delete:Anggota',
            'ViewAny:Kucing', 'View:Kucing', 'Create:Kucing', 'Update:Kucing', 'Delete:Kucing',
            'ViewAny:Edukasi', 'View:Edukasi', 'Create:Edukasi', 'Update:Edukasi', 'Delete:Edukasi',
            'ViewAny:Kegiatan', 'View:Kegiatan', 'Create:Kegiatan', 'Update:Kegiatan', 'Delete:Kegiatan',
            'ViewAny:LaporanKasus', 'View:LaporanKasus', 'Create:LaporanKasus', 'Update:LaporanKasus', 'Delete:LaporanKasus',
            'ViewAny:Adopsi', 'View:Adopsi', 'Create:Adopsi', 'Update:Adopsi', 'Delete:Adopsi',
            'ViewAny:Komentar', 'View:Komentar', 'Delete:Komentar',
            'ViewAny:KomentarPostingan', 'View:KomentarPostingan', 'Delete:KomentarPostingan',
            'ViewAny:User', 'View:User',
        ]);

        $adminDonasi = Role::firstOrCreate(['name' => 'admin_donasi', 'guard_name' => 'web']);
        $adminDonasi->syncPermissions([
            'ViewAny:Donasi', 'View:Donasi', 'Create:Donasi', 'Update:Donasi', 'Delete:Donasi',
            'ViewAny:Edukasi', 'View:Edukasi',
            'ViewAny:Kegiatan', 'View:Kegiatan',
            'ViewAny:KomentarPostingan', 'View:KomentarPostingan',
            'ViewAny:Anggota', 'View:Anggota',
            'ViewAny:Kucing', 'View:Kucing',
            'ViewAny:User', 'View:User',
        ]);

        Role::firstOrCreate(['name' => 'user', 'guard_name' => 'web']);

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $this->command->info('Roles & permissions synced with Filament Shield policies.');
        $this->command->info('  - super_admin  : full access');
        $this->command->info('  - admin_rescue : rescue resources + view users');
        $this->command->info('  - admin_donasi : donasi resources + view anggota/kucing/users');
        $this->command->info('  - user         : frontend only');
    }
}
