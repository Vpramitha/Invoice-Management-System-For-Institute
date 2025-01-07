<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseBatch extends Model
{
    use HasFactory;

    // The table associated with the model (optional if the table name follows Laravel convention)
    protected $table = 'course_batches';

    // Specify the columns that are mass assignable
    protected $fillable = [
        'course_id',
        'batch',
        'course_price',
        'registration_fee',
        'description',
        'start_date',
        'start_month',
    ];

    // Define the relationship between CourseBatch and Course
    public function course()
    {
        return $this->belongsTo(Course::class); // A batch belongs to one course
    }

    // Define the relationship between CourseBatch and StudentCourseBatch
    public function studentCourseBatch()
    {
        return $this->hasMany(StudentCourseBatch::class); // A course batch can have multiple student registrations
    }
}


