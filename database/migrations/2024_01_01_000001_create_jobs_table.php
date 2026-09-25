<?php

declare(strict_types=1);

use Ironflow\Database\Migrations\Migration;
use Ironflow\Database\Schema\Schema;
use Ironflow\Database\Schema\Table;

/**
 * Backs Ironflow\Queue\QueueManager (config/queue.php → 'table'/'failed_table').
 *
 * Note: available_at/reserved_at/created_at/failed_at are Unix timestamps
 * (PHP time()), written as plain integers by QueueManager — not SQL
 * DATETIME columns — so they're declared as bigInteger()/integer() here.
 */
class CreateJobsTable extends Migration
{
    public function up(): void
    {
        Schema::create('jobs', function (Table $t) {
            $t->id();
            $t->string('queue')->index();
            $t->text('payload');
            $t->integer('attempts')->default(0);
            $t->bigInteger('reserved_at')->nullable();
            $t->bigInteger('available_at');
            $t->bigInteger('created_at');
        });

        Schema::create('failed_jobs', function (Table $t) {
            $t->id();
            $t->string('queue');
            $t->text('payload');
            $t->text('exception');
            $t->bigInteger('failed_at');
        });
    }

    public function down(): void
    {
        Schema::drop('failed_jobs');
        Schema::drop('jobs');
    }
}
