<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            CREATE VIEW IF NOT EXISTS puskesmas AS
            SELECT
                ua.account_id,
                ua.full_name,
                ua.phone_number,
                ua.role,
                pa.password
            FROM user_accounts ua
            JOIN puskesmas_accounts pa ON ua.account_id = pa.account_id;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS puskesmas');
    }
};
