<?php

declare(strict_types=1);

use Marrow\Database\Migrations\Migration;
use Marrow\Database\Schema\Schema;
use Marrow\Database\Schema\Table;

/**
 * Backs Marrow\Auth\RBAC\Role — read/written with raw SQL by that class
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
