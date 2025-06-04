<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('test_trackers', function (Blueprint $table) {
            $table->char('test_id', 10)->primary();
            $table->enum('activity', ['RESULT_TIME', 'MESSAGE_SENT_TIME', 'MODIFY_TIME', 'READ', 'DOWNLOAD']);
            $table->timestamp('time');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('test_results');
    }
};
