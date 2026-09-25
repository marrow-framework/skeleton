<?php

declare(strict_types=1);

namespace Database\Seeders;

use Ironflow\Database\Seeder;
use Modules\Account\Database\Seeders\RolesTableSeeder;

/**
 * Master seeder — run with:
 *   php forge db:seed
 *   php forge db:seed --class=Database\\Seeders\\DatabaseSeeder
 *
 * (--class defaults to this exact class, so plain `db:seed` is enough.)
 * Delegates to each module's own seeder — this file itself stays a thin,
 * global entry point (db:seed has no --module option to target one
 * directly), while the actual seed data ownership lives with its module.
 */
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(RolesTableSeeder::class);
    }
}
