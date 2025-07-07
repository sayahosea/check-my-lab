<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('puskesmas_accounts', function (Blueprint $table) {
            $table->uuid('account_id')->unique();
            $table->string('password', 128);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('puskesmas_accounts');
    }
};
