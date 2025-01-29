<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = ['status', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payments()
    {
        return $this->belongsToMany(Payment::class, 'payment_invoice');
    }

    public function paymentInvoices()
    {
        return $this->hasMany(PaymentInvoice::class, 'invoice_id');
    }
}
