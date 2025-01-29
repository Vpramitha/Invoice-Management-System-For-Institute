<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Installment extends Model
{
    protected $fillable = ['course_batch_id', 'amount', 'installment'];

    public function courseBatch()
    {
        return $this->belongsTo(CourseBatch::class);
    }
}
