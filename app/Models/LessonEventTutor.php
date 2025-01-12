<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LessonEventTutor extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'lesson_event_id',
        'tutor_id',
    ];
}
