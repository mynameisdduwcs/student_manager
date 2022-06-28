<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectScore extends Model
{
    use HasFactory;
    protected $table = 'subject_scores';
    protected $fillable = ['student_id', 'subject_id', 'point'];
}
