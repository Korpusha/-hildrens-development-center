<?php

use App\Enums\RoleName;
use App\Models\Permission;
use App\Models\PermissionRole;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * @return void
     */
    public function up(): void
    {
        PermissionRole::query()
            ->insert([
                [
                    'permission_id' => Permission::query()->where('name', '=', 'frontend.frontend.index')->first()->id,
                    'role_name' => RoleName::Admin
                ],
                [
                    'permission_id' => Permission::query()->where('name', '=', 'frontend.frontend.index')->first()->id,
                    'role_name' => RoleName::Guest
                ],
                [
                    'permission_id' => Permission::query()->where('name', '=', 'frontend.frontend.index')->first()->id,
                    'role_name' => RoleName::Tutor
                ],
                [
                    'permission_id' => Permission::query()->where('name', '=', 'frontend.timetable.index')->first()->id,
                    'role_name' => RoleName::Admin
                ],
                [
                    'permission_id' => Permission::query()->where('name', '=', 'frontend.timetable.index')->first()->id,
                    'role_name' => RoleName::Guest
                ],
                [
                    'permission_id' => Permission::query()->where('name', '=', 'frontend.timetable.index')->first()->id,
                    'role_name' => RoleName::Tutor
                ],
                [
                    'permission_id' => Permission::query()->where('name', '=', 'frontend.timetable.show')->first()->id,
                    'role_name' => RoleName::Admin
                ],
                [
                    'permission_id' => Permission::query()->where('name', '=', 'frontend.timetable.show')->first()->id,
                    'role_name' => RoleName::Guest
                ],
                [
                    'permission_id' => Permission::query()->where('name', '=', 'frontend.timetable.show')->first()->id,
                    'role_name' => RoleName::Tutor
                ],
                [
                    'permission_id' => Permission::query()->where('name', '=', 'profile.edit')->first()->id,
                    'role_name' => RoleName::Admin
                ],
                [
                    'permission_id' => Permission::query()->where('name', '=', 'profile.edit')->first()->id,
                    'role_name' => RoleName::Tutor
                ],
                [
                    'permission_id' => Permission::query()->where('name', '=', 'profile.update')->first()->id,
                    'role_name' => RoleName::Admin
                ],
                [
                    'permission_id' => Permission::query()->where('name', '=', 'profile.update')->first()->id,
                    'role_name' => RoleName::Tutor
                ],
                [
                    'permission_id' => Permission::query()->where('name', '=', 'profile.destroy')->first()->id,
                    'role_name' => RoleName::Admin
                ],
                [
                    'permission_id' => Permission::query()->where('name', '=', 'profile.destroy')->first()->id,
                    'role_name' => RoleName::Tutor
                ],
                [
                    'permission_id' => Permission::query()->where('name', '=', 'dashboard.dashboard.index')->first()->id,
                    'role_name' => RoleName::Admin
                ],
                [
                    'permission_id' => Permission::query()->where('name', '=', 'dashboard.tutors.index')->first()->id,
                    'role_name' => RoleName::Admin
                ],
                [
                    'permission_id' => Permission::query()->where('name', '=', 'dashboard.tutors.create')->first()->id,
                    'role_name' => RoleName::Admin
                ],
                [
                    'permission_id' => Permission::query()->where('name', '=', 'dashboard.tutors.store')->first()->id,
                    'role_name' => RoleName::Admin
                ],
                [
                    'permission_id' => Permission::query()->where('name', '=', 'dashboard.tutors.edit')->first()->id,
                    'role_name' => RoleName::Admin
                ],
                [
                    'permission_id' => Permission::query()->where('name', '=', 'dashboard.tutors.update')->first()->id,
                    'role_name' => RoleName::Admin
                ],
                [
                    'permission_id' => Permission::query()->where('name', '=', 'dashboard.tutors.destroy')->first()->id,
                    'role_name' => RoleName::Admin
                ],
                [
                    'permission_id' => Permission::query()->where('name', '=', 'dashboard.activities.index')->first()->id,
                    'role_name' => RoleName::Admin
                ],
                [
                    'permission_id' => Permission::query()->where('name', '=', 'dashboard.activities.create')->first()->id,
                    'role_name' => RoleName::Admin
                ],
                [
                    'permission_id' => Permission::query()->where('name', '=', 'dashboard.activities.store')->first()->id,
                    'role_name' => RoleName::Admin
                ],
                [
                    'permission_id' => Permission::query()->where('name', '=', 'dashboard.activities.edit')->first()->id,
                    'role_name' => RoleName::Admin
                ],
                [
                    'permission_id' => Permission::query()->where('name', '=', 'dashboard.activities.update')->first()->id,
                    'role_name' => RoleName::Admin
                ],
                [
                    'permission_id' => Permission::query()->where('name', '=', 'dashboard.activities.destroy')->first()->id,
                    'role_name' => RoleName::Admin
                ],
                [
                    'permission_id' => Permission::query()->where('name', '=', 'dashboard.cabinets.index')->first()->id,
                    'role_name' => RoleName::Admin
                ],
                [
                    'permission_id' => Permission::query()->where('name', '=', 'dashboard.cabinets.create')->first()->id,
                    'role_name' => RoleName::Admin
                ],
                [
                    'permission_id' => Permission::query()->where('name', '=', 'dashboard.cabinets.store')->first()->id,
                    'role_name' => RoleName::Admin
                ],
                [
                    'permission_id' => Permission::query()->where('name', '=', 'dashboard.cabinets.edit')->first()->id,
                    'role_name' => RoleName::Admin
                ],
                [
                    'permission_id' => Permission::query()->where('name', '=', 'dashboard.cabinets.update')->first()->id,
                    'role_name' => RoleName::Admin
                ],
                [
                    'permission_id' => Permission::query()->where('name', '=', 'dashboard.cabinets.destroy')->first()->id,
                    'role_name' => RoleName::Admin
                ],
                [
                    'permission_id' => Permission::query()->where('name', '=', 'dashboard.timetable.index')->first()->id,
                    'role_name' => RoleName::Admin
                ],
                [
                    'permission_id' => Permission::query()->where('name', '=', 'dashboard.timetable.show')->first()->id,
                    'role_name' => RoleName::Admin
                ],
                [
                    'permission_id' => Permission::query()->where('name', '=', 'dashboard.lesson-events.create')->first()->id,
                    'role_name' => RoleName::Admin
                ],
                [
                    'permission_id' => Permission::query()->where('name', '=', 'dashboard.lesson-events.store')->first()->id,
                    'role_name' => RoleName::Admin
                ],
                [
                    'permission_id' => Permission::query()->where('name', '=', 'dashboard.lesson-events.destroy')->first()->id,
                    'role_name' => RoleName::Admin
                ],
            ]);
    }

    /**
     * @return void
     */
    public function down(): void
    {
        PermissionRole::query()
            ->delete();
    }
};
