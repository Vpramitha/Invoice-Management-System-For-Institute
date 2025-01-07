<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    // The table associated with the model (optional if it follows Laravel convention)
    protected $table = 'payments';

    // Specify the fields that are mass assignable
    protected $fillable = [
        'student_course_batch_id',
        'payment_amount',
        'paid_date',
        'installment',
    ];

    // Define the relationship to the StudentCourseBatch model (many-to-one)
    public function studentCourseBatch()
    {
        return $this->belongsTo(StudentCourseBatch::class);
    }
}
