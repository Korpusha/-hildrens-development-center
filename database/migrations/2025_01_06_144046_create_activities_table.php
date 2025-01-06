<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * @return void
     */
    public function up(): void
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->string('name')->primary();
            $table->string('description')->nullable(false);
            $table->unsignedSmallInteger('duration_minutes')->nullable(false);
            $table->enum('type', ['individual', 'group'])->nullable(false);
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
