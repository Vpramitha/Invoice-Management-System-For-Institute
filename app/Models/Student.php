<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    // Define the table name if it's not the plural form of the model name (optional)
    protected $table = 'students';

    // Define the primary key (optional, since it's 'id' by default)
    protected $primaryKey = 'id';

    // Define the fields that are mass assignable
    protected $fillable = [
        'name',
        'email',
        
    ];

    // If you want to allow timestamps (created_at, updated_at), Laravel will manage them automatically
    public $timestamps = true;

    // Define the relationship between Student and StudentCourseBatch
    public function courseBatches()
    {
        return $this->hasMany(StudentCourseBatch::class); // A student can have multiple course batch registrations
    }
}
