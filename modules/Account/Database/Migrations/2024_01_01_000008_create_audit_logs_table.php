<?php

declare(strict_types=1);

use Ironflow\Database\Migrations\Migration;
use Ironflow\Database\Schema\Schema;
use Ironflow\Database\Schema\Table;

/**
 * Required by any Model using the Auditable trait (auditCreated/
 * auditUpdated/auditDeleted). Only needed if at least one model in the app
 * opts into `use Auditable;` — safe to remove this migration otherwise.
 */
class CreateAuditLogsTable extends Migration
{
    public function up(): void
    {
        Schema::create('audit_logs', function (Table $t) {
            $t->id();
            $t->unsignedBigInteger('user_id')->nullable();
            $t->string('event');
            $t->string('model_type');
            $t->string('model_id')->nullable();
            $t->json('old_values')->nullable();
            $t->json('new_values')->nullable();
            $t->string('ip_address', 45)->nullable();
            $t->text('user_agent')->nullable();
            $t->timestamp('created_at')->nullable();

            $t->index(['model_type', 'model_id']);
            $t->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::drop('audit_logs');
    }
}
