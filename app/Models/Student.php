<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Student extends Model
{
    use HasFactory;
    use Sluggable;

    protected $table = 'students';
    protected $fillable = [
        'name',
        'avatar',
        'gender',
        'birthdate',
        'phone',
        'email',
        'faculty_id',
        'slug',
        'user_id',
        'description',
    ];

//    protected function fullName(): Attribute
//    {
//        return Attribute::make(
//            get: fn($value, $attributes) => $attributes['first_name'] . ' ' . $attributes['last_name'],
//        );
//    }


    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'subject_scores')->withPivot('point');
    }

    public function point()
    {
        return $this->hasMany(SubjectScore::class, 'student_id', 'id');
    }

    protected function age(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                $date = new \DateTime($attributes['birthdate']);
                $now = new \DateTime();
                return $now->diff($date)->y;
            },
        );
    }

    /**
     * Interact with the user's first name.
     *
     * @param  string  $value
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => Hash::make($value),
        );
    }

    /**
     * @return \string[][]
     */
    public function sluggable(): array
    {
        return [
            'slug'=>[
                'source'=>'name'
            ]
        ];
        // TODO: Implement sluggable() method.
    }
}
