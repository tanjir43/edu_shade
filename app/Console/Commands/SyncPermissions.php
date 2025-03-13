<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class SyncPermissions extends Command
{
    protected $signature = 'permissions:sync';
    protected $description = 'Sync roles and permissions';

    private array $permissionGroups = [
        'Role' => ['create', 'edit', 'view', 'delete'],
        'Settings' => ['view', 'save'],
    ];

    public function handle()
    {
        $this->info('Syncing roles and permissions...');
        $this->registerPermissions();
        $this->info('Permissions synced successfully.');
    }

    private function registerPermissions(): void
    {
        $roles = [
            'Super admin', 'Admin', 'Teacher', 'Student', 'Parents', 'Accountant',
            'Receptionist', 'Librarian', 'Driver', 'Alumni', "Hostel manager",
            "Medical officer", "IT administrator", "Sports coach", "Lab Assistant"
        ];

        foreach ($roles as $roleName) {
            Role::updateOrCreate(
                ['name' => $roleName, 'school_id' => 1, 'branch_id' => 1],
                ['type' => 'system', 'created_at' => Carbon::now()]
            );
        }

        $permissions = collect();
        foreach ($this->permissionGroups as $group => $actions) {
            foreach ($actions as $action) {
                $permissions->push($this->createPermission($group, $action));
            }
        }

        $this->assignAllPermissionsToRole($permissions, 'Super admin');
    }

    private function createPermission(string $group, string $action): Permission
    {
        return Permission::firstOrCreate([
            'name' => strtolower($group) . '.' . $action,
            'guard_name' => 'web',
        ], [
            'group_name' => $group,
            'school_id' => 1,
            'branch_id' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }

    private function assignAllPermissionsToRole(Collection $permissions, string $roleName): void
    {
        $role = Role::firstOrCreate(
            ['name' => $roleName],
            ['type' => 'system', 'school_id' => 1]
        );

        $role->syncPermissions($permissions);
    }
}
