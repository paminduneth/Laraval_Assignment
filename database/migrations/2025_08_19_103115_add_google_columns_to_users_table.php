<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                // Only add columns that don't exist
                if (!Schema::hasColumn('users', 'google_token')) {
                    $table->text('google_token')->nullable()->after('google_id');
                }
                if (!Schema::hasColumn('users', 'google_refresh_token')) {
                    $table->text('google_refresh_token')->nullable()->after('google_token');
                }
                if (!Schema::hasColumn('users', 'google_token_expires_at')) {
                    $table->datetime('google_token_expires_at')->nullable()->after('google_refresh_token');
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn([
                    'google_token',
                    'google_refresh_token',
                    'google_token_expires_at',
                ]);
            });
        }
    }
};