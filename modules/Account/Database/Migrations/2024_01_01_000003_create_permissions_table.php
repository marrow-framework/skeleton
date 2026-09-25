<?php

declare(strict_types=1);

use Ironflow\Database\Migrations\Migration;
use Ironflow\Database\Schema\Schema;
use Ironflow\Database\Schema\Table;

/**
 * Backs Ironflow\Auth\RBAC\Permission. Slug convention: "resource.action"
 * (e.g. "posts.create", "users.delete") — see Permission::class docblock.
 */
class CreatePermissionsTable extends Migration
{
    public function up(): void
    {
        Schema::create('permissions', function (Table $t) {
            $t->id();
            $t->string('name');
            $t->string('slug')->unique();
            $t->string('group')->nullable();
            $t->text('description')->nullable();
            $t->timestamps();
        });
    }

    public function down(): void
    {
        Schema::drop('permissions');
    }
}
