<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('outbreaks', function (Blueprint $table) {
            $table->string('location_id', 64);
            $table->string('virus_id', 64);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('outbreaks');
    }
};
