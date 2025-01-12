<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class LessonEvent extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var list<string, string>
     */
    protected $casts = [
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
    ];

    /**
     * @var list<string>
     */
    protected $fillable = [
        'date',
        'start_time',
        'cabinet_code',
        'activity_name',
        'end_time',
    ];

    /**
     * @return HasMany
     */
    public function lessonEventTutors(): HasMany
    {
        return $this->hasMany(LessonEventTutor::class, 'lesson_event_id', 'id');
    }

    /**
     * @return HasManyThrough
     */
    public function tutors(): HasManyThrough
    {
        return $this->hasManyThrough(Tutor::class, LessonEventTutor::class, 'lesson_event_id', 'user_id', 'id', 'id');
    }
}
