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
        DB::unprepared("
            CREATE PROCEDURE IF NOT EXISTS sp_create_medic_account (
                IN arg_full_name VARCHAR(60),
                IN arg_phone_number VARCHAR(15),
                IN arg_password VARCHAR(128)
            )

            BEGIN
                DECLARE id_akun CHAR(36);
                SET id_akun = UUID();

                INSERT INTO user_accounts (account_id, role, full_name, phone_number)
                VALUES (id_akun, 'MEDIS', arg_full_name, arg_phone_number);

                INSERT INTO puskesmas_accounts (account_id, password)
                VALUES (id_akun, arg_password);
            END
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP PROCEDURE IF EXISTS sp_create_medic_account');
    }
};
