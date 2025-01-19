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
        return $this->belongsTo(Student::class, 'student_id', 'id'); // Ensure 'student_id' matches the column name in your table
    }


    // Define the relationship to the CourseBatch model (many-to-one)
    public function courseBatch()
    {
        return $this->belongsTo(CourseBatch::class);
    }

    // Add the relationship for payments
    public function payments()
    {
        return $this->hasMany(Payment::class, 'student_course_batch_id', 'id');
    }
    
    
}

