<?php

declare(strict_types=1);

use Ironflow\Database\Migrations\Migration;
use Ironflow\Database\Schema\Schema;
use Ironflow\Database\Schema\Table;

/**
 * Backs Ironflow\Auth\RBAC\Role — read/written with raw SQL by that class
 * and by the HasRole trait, not through the Model/ORM layer.
 */
class CreateRolesTable extends Migration
{
    public function up(): void
    {
        Schema::create('roles', function (Table $t) {
            $t->id();
            $t->string('name');
            $t->string('slug')->unique();
            $t->text('description')->nullable();
            $t->timestamps();
        });
    }

    public function down(): void
    {
        Schema::drop('roles');
    }
}
