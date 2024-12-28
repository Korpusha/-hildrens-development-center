<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_roles', function (Blueprint $table) {
            $table->foreignIdFor(User::class, 'user_id')->constrained();
            $table->string('role_name');
            $table
                ->foreign('role_name')
                ->references('name')
                ->on('roles')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->primary(['user_id', 'role_name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_roles');
    }
};
