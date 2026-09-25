<?php

declare(strict_types=1);

use Ironflow\Database\Migrations\Migration;
use Ironflow\Database\Schema\Schema;
use Ironflow\Database\Schema\Table;

/**
 * Optional direct user → permission grants for the HasPermission trait's
 * givePermissionTo()/revokePermissionTo(). The trait already tolerates this
 * table being absent (role-based permissions still work), but creating it
 * up front avoids a silent no-op the first time someone calls
 * $user->givePermissionTo(...) directly.
 */
class CreateUserPermissionsTable extends Migration
{
    public function up(): void
    {
        Schema::create('user_permissions', function (Table $t) {
            $t->id();
            $t->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $t->foreignId('permission_id')->constrained('permissions')->cascadeOnDelete();
            $t->unique(['user_id', 'permission_id']);
        });
    }

    public function down(): void
    {
        Schema::drop('user_permissions');
    }
}
