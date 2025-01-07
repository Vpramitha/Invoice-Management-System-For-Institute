<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    // Define the table name (optional, if it is different from the default "courses")
    protected $table = 'courses';

    // Define the fillable columns
    protected $fillable = [
        'course_name',
        'description',
        'instructor',
        'support_staff',
    ];

    // Specify the relationship between Course and CourseBatch
    public function courseBatches()
    {
        return $this->hasMany(CourseBatch::class); // A course can have multiple batches
    }
}
