<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';
    protected $fillable = [
        'first_name',
        'last_name',
        'avatar',
        'gender',
        'birthdate',
        'hometown',
        'phone',
        'email',
        'faculty_id',
        'description',
    ];

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) => $attributes['first_name'] . ' ' . $attributes['last_name'],
        );
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'subject_scores')->withPivot('point');
    }
    public function point()
    {
        return $this->hasMany(SubjectScore::class,'student_id','id');
    }

    protected function age(): Attribute
    {
        return Attribute::make(
            get:function ($value, $attributes){
             $date =new \DateTime($attributes['birthdate']);
             $now= new \DateTime();
             return $now->diff($date)->y;
            },
        );
    }



}
