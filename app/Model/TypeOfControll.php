<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;

class TypeOfControll extends Model
{
    protected $table = 'type_of_controll';
    protected $primaryKey = 'controll_id';
    public $timestamps = false;

    protected $fillable = [
        'controll_name'
    ];

    public function syllabuses()
    {
        return $this->hasMany(Syllabus::class, 'controll_id');
    }
}