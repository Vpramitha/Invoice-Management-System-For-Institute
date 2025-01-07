<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id(); // Auto-incremented ID
            $table->unsignedBigInteger('student_course_batch_id'); // Foreign key to the student_course_batches table
            $table->decimal('payment_amount', 10, 2); // Payment amount
            $table->date('paid_date'); // Payment date
            $table->integer('installment')->nullable(); // Installment number (nullable, in case it's a full payment)
            $table->timestamps(); // Created at and updated at timestamps

            // Foreign key constraint
            $table->foreign('student_course_batch_id')->references('id')->on('student_course_batches')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
