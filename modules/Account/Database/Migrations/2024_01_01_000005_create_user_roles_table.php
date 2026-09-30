<?php

declare(strict_types=1);

use Marrow\Database\Migrations\Migration;
use Marrow\Database\Schema\Schema;
use Marrow\Database\Schema\Table;

/**
 * Pivot for the HasRole trait — $user->assignRole()/roles()/hasRole().
 */
class CreateUserRolesTable extends Migration
{
    public function up(): void
    {
        Schema::create('user_roles', function (Table $t) {
            $t->id();
            $t->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $t->foreignId('role_id')->constrained('roles')->cascadeOnDelete();
            $t->unique(['user_id', 'role_id']);
        });
    }

    public function down(): void
    {
        Schema::drop('user_roles');
    }
}
