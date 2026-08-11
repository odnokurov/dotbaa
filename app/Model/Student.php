<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';
    protected $primaryKey = 'student_id';
    public $timestamps = false;

    protected $fillable = [
        'surname',
        'name',
        'patronymic',
        'gender',
        'birthday',
        'address',
        'group_id'
    ];

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function grades()
    {
        return $this->hasMany(Grade::class, 'student_id');
    }
}