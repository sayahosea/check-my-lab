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
            CREATE PROCEDURE IF NOT EXISTS sp_create_patient_account (
                IN arg_full_name VARCHAR(60),
                IN arg_phone_number VARCHAR(15),
                IN arg_patient_nik VARCHAR(16),
                IN arg_patient_erm VARCHAR(8)
            )

            BEGIN
                DECLARE id_akun CHAR(36);
                SET id_akun = UUID();

                INSERT INTO user_accounts (account_id, role, full_name, phone_number)
                VALUES (id_akun, 'PASIEN', arg_full_name, arg_phone_number);

                INSERT INTO patient_accounts (account_id, patient_nik, patient_erm)
                VALUES (id_akun, arg_patient_nik, arg_patient_erm);
            END
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP PROCEDURE IF EXISTS sp_create_patient_account');
    }
};
