<?php

use App\Enums\RoleName;
use App\Models\Role;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Role::query()
            ->insert([
                ['name' => RoleName::Admin],
                ['name' => RoleName::Guest],
                ['name' => RoleName::Tutor],
            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Role::query()
            ->whereIn('name', [RoleName::Admin, RoleName::Guest, RoleName::Tutor])
            ->delete();
    }
};
