<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Disable foreign key checks temporarily
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Drop the table if it exists to ensure clean creation
        Schema::dropIfExists('likes');

        // Create table using raw SQL
        DB::statement("
            CREATE TABLE `likes` (
                `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                `user_id` int(11) NOT NULL,
                `photo_id` int(11) NOT NULL,
                `created_at` timestamp NULL DEFAULT NULL,
                PRIMARY KEY (`id`),
                UNIQUE KEY `likes_user_id_photo_id_unique` (`user_id`,`photo_id`),
                KEY `likes_photo_id_foreign` (`photo_id`),
                CONSTRAINT `likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
                CONSTRAINT `likes_photo_id_foreign` FOREIGN KEY (`photo_id`) REFERENCES `photos` (`photo_id`) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ");

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};