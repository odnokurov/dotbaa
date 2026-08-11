<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;

class Syllabus extends Model
{
    protected $table = 'syllabus';
    protected $primaryKey = 'syllabus_id';
    public $timestamps = false;

    protected $fillable = [
        'course',
        'semestr',
        'group_id',
        'subject_id',
        'number_of_hours',
        'controll_id'
    ];

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function typeOfControll()
    {
        return $this->belongsTo(TypeOfControll::class, 'controll_id');
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'syllabus_id');
    }

    // Указывает курс/семестр для дисциплины группы
    public function updateSemester($course, $semestr)
    {
        $this->course = $course;
        $this->semestr = $semestr;
        return $this->save();
    }

    // Указывает вид контроля для дисциплины группы
    public function updateControl($controllId)
    {
        $this->controll_id = $controllId;
        return $this->save();
    }
}