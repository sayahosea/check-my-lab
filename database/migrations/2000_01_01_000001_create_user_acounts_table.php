<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_accounts', function (Blueprint $table) {
            $table->uuid('account_id')->primary();
            $table->enum('role', ['PASIEN', 'MEDIS', 'LAB']);
            $table->string('full_name', 60)->nullable();
            $table->string('phone_number', 15)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_accounts');
    }
};
