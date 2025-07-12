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
            $table->integer('region_id');
            $table->integer('virus_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('outbreaks');
    }
};
