<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $table = 'subjects';
    protected $fillable = ['name',];

    public function point()
    {
        return $this->hasMany(SubjectScore::class,'subject_id','id');
    }
}
