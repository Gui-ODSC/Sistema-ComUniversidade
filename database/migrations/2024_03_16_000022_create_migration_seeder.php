<?php

use Database\Seeders\DatabaseSeeder;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Artisan::call('db:seed', [
            '--class' => DatabaseSeeder::class,
            '--force' => true,
            '--no-interaction' => true
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
    }
};
