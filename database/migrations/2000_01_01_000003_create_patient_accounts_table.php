<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('patient_accounts', function (Blueprint $table) {
            $table->uuid('account_id')->unique();
            $table->char('patient_nik', 16)->unique();
            $table->char('patient_erm', 8)->unique();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patient_accounts');
    }
};
