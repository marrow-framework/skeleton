<?php

declare(strict_types=1);

use Marrow\Database\Migrations\Migration;
use Marrow\Database\Schema\Schema;
use Marrow\Database\Schema\Table;

/**
 * Backs Marrow\Notifications\NotificationManager's 'database' channel
 * (config/notifications.php → 'table'). created_at/read_at are Unix
 * timestamps written as plain integers, matching NotificationManager.
 */
class CreateNotificationsTable extends Migration
{
    public function up(): void
    {
        Schema::create('notifications', function (Table $t) {
            $t->id();
            $t->string('type');
            $t->string('notifiable_type');
            $t->unsignedBigInteger('notifiable_id');
            $t->json('data');
            $t->bigInteger('read_at')->nullable();
            $t->bigInteger('created_at');

            $t->index(['notifiable_type', 'notifiable_id']);
        });
    }

    public function down(): void
    {
        Schema::drop('notifications');
    }
}
