<?php

namespace App\Models;

use App\Enums\ActivityType;
use Illuminate\Database\Eloquent\Model;

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
}
