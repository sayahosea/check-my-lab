<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('test_results', function (Blueprint $table) {
            $table->char('test_id', 10);
            $table->char('account_id', 36);
            $table->binary('test_file');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('test_results');
    }
};
