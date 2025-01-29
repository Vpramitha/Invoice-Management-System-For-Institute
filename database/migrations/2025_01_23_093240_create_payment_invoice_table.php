<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_invoice', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->foreignId('payment_id')->constrained('payments')->onDelete('cascade'); // Foreign key to the payments table
            $table->foreignId('invoice_id')->constrained('invoices')->onDelete('cascade'); // Foreign key to the invoices table
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_invoice');
    }
}
