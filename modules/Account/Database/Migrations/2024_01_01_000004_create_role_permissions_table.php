<?php

declare(strict_types=1);

use Marrow\Database\Migrations\Migration;
use Marrow\Database\Schema\Schema;
use Marrow\Database\Schema\Table;

/**
 * Pivot for Role::givePermissionTo() / Role::permissions().
 */
class CreateRolePermissionsTable extends Migration
{
    public function up(): void
    {
        Schema::create('role_permissions', function (Table $t) {
            $t->id();
            $t->foreignId('role_id')->constrained('roles')->cascadeOnDelete();
            $t->foreignId('permission_id')->constrained('permissions')->cascadeOnDelete();
            $t->unique(['role_id', 'permission_id']);
        });
    }

    public function down(): void
    {
        Schema::drop('role_permissions');
    }
}
