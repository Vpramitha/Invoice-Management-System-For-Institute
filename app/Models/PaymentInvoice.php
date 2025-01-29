<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentInvoice extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'payment_invoice';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'payment_id',
        'invoice_id',
    ];

    /**
     * Relationships
     */

    // Define the relationship with the Payment model
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    // Define the relationship with the Invoice model
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
