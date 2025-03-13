<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    private array $permissionGroups = [
        'Role' => ['create', 'edit', 'view', 'delete'],
        'Settings' => ['view', 'save'],
    ];

    public function run(): void
    {
        $this->createRole();
        $permissions = $this->createPermissions();
        $this->assignAllPermissionsToRole($permissions, 'superadmin');
    }

    private function createRole(): void
    {
        $roles = [
            'Super admin',
            'Admin',
            'Teacher',
            'Student',
            'Parents',
            'Accountant',
            'Receptionist',
            'Librarian',
            'Driver',
            'Alumni',
            "Hostel manager",
            "Medical officer",
            "IT administrator",
            "Sports coach",
            "Lab Assistant"
        ];

        foreach ($roles as $roleName) {
            Role::updateOrCreate(
                [
                    'name'      => $roleName,
                    'school_id' => 1,
                    'branch_id' => 1
                ],
                [
                    'type'       => 'system',
                    'created_at' => Carbon::now(),
                ]
            );
        }
    }

    private function createPermissions(): Collection
    {
        $permissions = collect();

        foreach ($this->permissionGroups as $group => $actions) {
            foreach ($actions as $action) {
                $permissions->push($this->createPermission($group, $action));
            }
        }

        return $permissions;
    }

    private function createPermission(string $group, string $action): Permission
    {
        return Permission::firstOrCreate([
            'name' => strtolower($group) . '.' . $action,
            'guard_name' => 'web',
        ], [
            'group_name' => $group,
            'school_id'     => 1,
            'branch_id'     => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);
    }

    private function assignAllPermissionsToRole(\Illuminate\Support\Collection $permissions, string $roleName): void
    {
        $role = Role::firstOrCreate(
            ['name' => $roleName],
            ['type' => 'system', 'school_id' => 1]
        );

        $role->syncPermissions($permissions);
    }
}
