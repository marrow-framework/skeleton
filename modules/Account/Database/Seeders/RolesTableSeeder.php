<?php

declare(strict_types=1);

namespace Modules\Account\Database\Seeders;

use Marrow\Auth\RBAC\Permission;
use Marrow\Auth\RBAC\Role;
use Marrow\Database\Seeder;

/**
 * Seeds the baseline RBAC roles (admin/editor/viewer). 'admin' matches
 * config/rbac.php's default super_admin_role, so any user assigned it
 * bypasses every Gate check automatically — no permissions need to be
 * attached to it for that reason, but a few are given here anyway so
 * `php forge tinker` has something to inspect.
 *
 * Note: the base Marrow\Database\Seeder has no output()/info() helper —
 * plain echo is the convention framework-wide seeders use.
 */
class RolesTableSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Role::findOrCreate('Administrator', 'admin', 'Full access to everything.');
        $editor = Role::findOrCreate('Editor', 'editor', 'Can manage content.');
        $viewer = Role::findOrCreate('Viewer', 'viewer', 'Read-only access.');

        $manageContent = Permission::findOrCreate('Manage content', 'content.manage', 'content');
        $viewContent = Permission::findOrCreate('View content', 'content.view', 'content');

        $editor->givePermissionTo($manageContent);
        $editor->givePermissionTo($viewContent);
        $viewer->givePermissionTo($viewContent);

        echo "  Seeded roles: admin, editor, viewer\n";
    }
}
