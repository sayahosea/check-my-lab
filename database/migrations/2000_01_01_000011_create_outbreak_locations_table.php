<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('outbreak_locations', function (Blueprint $table) {
            $table->string('id', 64);
            $table->string('name', 64);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('outbreak_locations');
    }
};
