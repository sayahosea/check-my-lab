<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('outbreak_regions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 64);
            $table->double('latitude');
            $table->double('longitude');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('outbreak_regions');
    }
};
