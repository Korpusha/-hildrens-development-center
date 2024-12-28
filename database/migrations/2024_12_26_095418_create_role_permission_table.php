<?php

use App\Models\Permission;
use App\Models\Role;
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
        Schema::create('role_permissions', function (Blueprint $table) {
            $table->string('role_name');
            $table
                ->foreign('role_name')
                ->references('name')
                ->on('roles')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignIdFor(Permission::class, 'permission_id')->constrained();
            $table->primary(['role_name', 'permission_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_permissions');
    }
};
