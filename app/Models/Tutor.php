<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Tutor extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $primaryKey = 'user_id';

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @return BelongsToMany
     */
    public function activityTutorSpecializations(): BelongsToMany
    {
        return $this->belongsToMany(Activity::class, app(ActivityTutorSpecialization::class)->getTable(), 'tutor_id', 'activity_name', 'user_id', 'name');
    }

    /**
     * @return HasMany
     */
    public function lessonEventTutors(): HasMany
    {
        return $this->hasMany(LessonEventTutor::class, 'tutor_id', 'id');
    }

    /**
     * @return HasManyThrough
     */
    public function lessonEvents(): HasManyThrough
    {
        return $this->hasManyThrough(LessonEvent::class, LessonEventTutor::class, 'user_id', 'lesson_event_id', 'id', 'id');
    }
}
