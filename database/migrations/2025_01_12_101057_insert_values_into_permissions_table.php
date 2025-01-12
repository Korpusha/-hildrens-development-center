<?php

use App\Models\Permission;
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
        Permission::query()
            ->insert([
                ['name' => 'frontend.frontend.index'],
                ['name' => 'frontend.timetable.index'],
                ['name' => 'frontend.timetable.show'],
                ['name' => 'profile.edit'],
                ['name' => 'profile.update'],
                ['name' => 'profile.destroy'],
                ['name' => 'dashboard.dashboard.index'],
                ['name' => 'dashboard.tutors.index'],
                ['name' => 'dashboard.tutors.create'],
                ['name' => 'dashboard.tutors.store'],
                ['name' => 'dashboard.tutors.edit'],
                ['name' => 'dashboard.tutors.update'],
                ['name' => 'dashboard.tutors.destroy'],
                ['name' => 'dashboard.activities.index'],
                ['name' => 'dashboard.activities.create'],
                ['name' => 'dashboard.activities.store'],
                ['name' => 'dashboard.activities.edit'],
                ['name' => 'dashboard.activities.update'],
                ['name' => 'dashboard.activities.destroy'],
                ['name' => 'dashboard.cabinets.index'],
                ['name' => 'dashboard.cabinets.create'],
                ['name' => 'dashboard.cabinets.store'],
                ['name' => 'dashboard.cabinets.edit'],
                ['name' => 'dashboard.cabinets.update'],
                ['name' => 'dashboard.cabinets.destroy'],
                ['name' => 'dashboard.timetable.index'],
                ['name' => 'dashboard.timetable.show'],
                ['name' => 'dashboard.lesson-events.create'],
                ['name' => 'dashboard.lesson-events.store'],
                ['name' => 'dashboard.lesson-events.destroy'],
            ]);
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Permission::query()
            ->whereIn('name', [
                'frontend.frontend.index',
                'frontend.timetable.index',
                'frontend.timetable.show',
                'profile.edit',
                'profile.update',
                'profile.destroy',
                'dashboard.dashboard.index',
                'dashboard.tutors.index',
                'dashboard.tutors.create',
                'dashboard.tutors.store',
                'dashboard.tutors.edit',
                'dashboard.tutors.update',
                'dashboard.tutors.destroy',
                'dashboard.activities.index',
                'dashboard.activities.create',
                'dashboard.activities.store',
                'dashboard.activities.edit',
                'dashboard.activities.update',
                'dashboard.activities.destroy',
                'dashboard.cabinets.index',
                'dashboard.cabinets.create',
                'dashboard.cabinets.store',
                'dashboard.cabinets.edit',
                'dashboard.cabinets.update',
                'dashboard.cabinets.destroy',
                'dashboard.timetable.index',
                'dashboard.timetable.show',
                'dashboard.lesson-events.create',
                'dashboard.lesson-events.store',
                'dashboard.lesson-events.destroy',
            ])
            ->delete();
    }
};
