<?php

declare(strict_types=1);

use Marrow\Database\Migrations\Migration;
use Marrow\Database\Schema\Schema;
use Marrow\Database\Schema\Table;

/**
 * Required columns for the HasTwoFactor trait, kept in a separate migration
 * so 2FA can be dropped from a project without touching the base users table
 * migration. two_factor_secret is stored AES-256-GCM encrypted (see
 * Auth\Concerns\HasTwoFactor / Support\Crypto), not plaintext.
 */
class AddTwoFactorColumnsToUsersTable extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Table $t) {
            $t->string('two_factor_secret', 512)->nullable();
            $t->text('two_factor_recovery_codes')->nullable();
            $t->timestamp('two_factor_enabled_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Table $t) {
            $t->dropColumn(['two_factor_secret', 'two_factor_recovery_codes', 'two_factor_enabled_at']);
        });
    }
}
