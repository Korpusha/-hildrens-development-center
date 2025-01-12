<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Log;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'date_of_birth',
        'email',
        'password',
    ];

    /**
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, app(RoleUser::class)->getTable(), 'user_id', 'role_name', 'id', 'name');
    }

    /**
     * @return HasOne
     */
    public function tutor(): HasOne
    {
        return $this->hasOne(Tutor::class, 'user_id', 'id');
    }

    /**
     * @param string $routeName
     * @return bool
     */
    public function hasPermission(string $routeName): bool
    {
        $permission = Permission::query()->where('name', '=', $routeName)->first();
        if (!$permission instanceof Permission) {
            return true;
        }

        return PermissionRole::query()
            ->where('permission_id', '=', $permission->id)
            ->whereIn('role_name', $this->roles()->pluck('name')->toArray())
            ->exists();
    }
}
