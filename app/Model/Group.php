<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'groups';
    protected $primaryKey = 'group_id';
    public $timestamps = false;

    protected $fillable = [
        'group_name'
    ];

    public function students()
    {
        return $this->hasMany(Student::class, 'group_id');
    }

    public function syllabuses()
    {
        return $this->hasMany(Syllabus::class, 'group_id');
    }

    public function grades()
    {
        return $this->hasMany(Grade::class, 'group_id');
    }

    public function getSubjects()
    {
        return $this->syllabuses()->with('subject', 'typeOfControll')->get();
    }
}