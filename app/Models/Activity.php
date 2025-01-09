<?php

namespace App\Models;

use App\Enums\ActivityType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Activity extends Model
{
    /**
     * @var string
     */
    protected $primaryKey = 'name';

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'description',
        'duration_minutes',
        'type',
    ];

    /**
     * @return string
     */
    public function getTypeDisplayAttribute() : string
    {
        return ActivityType::from($this->type)->name;
    }

    /**
     * @return BelongsToMany
     */
    public function activityTutorSpecializations(): BelongsToMany
    {
        return $this->belongsToMany(Tutor::class, app(ActivityTutorSpecialization::class)->getTable(), 'activity_name', 'tutor_id', 'name', 'user_id');
    }
}
