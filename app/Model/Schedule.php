<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedule';
    protected $primaryKey = 'schedule_id';
    public $timestamps = false;

    protected $fillable = [
        'date_of_lesson',
        'lesson_number',
        'classroom',
        'lesson_type',
        'syllabus_id',
        'user_id'
    ];

    public function syllabus()
    {
        return $this->belongsTo(Syllabus::class, 'syllabus_id');
    }
}