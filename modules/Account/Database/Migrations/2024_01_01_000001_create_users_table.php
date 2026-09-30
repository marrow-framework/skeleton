<?php

declare(strict_types=1);

use Marrow\Database\Migrations\Migration;
use Marrow\Database\Schema\Schema;
use Marrow\Database\Schema\Table;

/**
 * The base `users` table — required by both the session and JWT auth guards
 * (config/auth.php → guards.*.table). Column names ('email', 'password')
 * follow the guards' defaults; change them here and in config/auth.php
 * together if you rename either.
 */
class CreateUsersTable extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Table $t) {
            $t->id();
            $t->string('name');
            $t->string('email')->unique();
            $t->timestamp('email_verified_at')->nullable();
            $t->string('password');
            $t->timestamps();
        });
    }

    public function down(): void
    {
        Schema::drop('users');
    }
}
