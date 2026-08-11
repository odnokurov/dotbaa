<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subjects';
    protected $primaryKey = 'subject_id';
    public $timestamps = false;

    protected $fillable = [
        'subject_name'
    ];

    public function syllabuses()
    {
        return $this->hasMany(Syllabus::class, 'subject_id');
    }
}