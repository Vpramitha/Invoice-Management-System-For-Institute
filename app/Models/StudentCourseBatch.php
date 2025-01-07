<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentCourseBatch extends Model
{
    use HasFactory;

    // The table associated with the model (optional if it follows Laravel convention)
    protected $table = 'student_course_batches';

    // Specify the fields that are mass assignable
    protected $fillable = [
        'student_id',
        'course_batch_id',
        'registration_fee',
        'full_payment',
    ];

    // Define the relationship to the Student model (many-to-one)
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    // Define the relationship to the CourseBatch model (many-to-one)
    public function courseBatch()
    {
        return $this->belongsTo(CourseBatch::class);
    }

    // Define the relationship between StudentCourseBatch and Payment
    public function payments()
    {
        return $this->hasMany(Payment::class); // A student-course batch can have multiple payments
    }
}

