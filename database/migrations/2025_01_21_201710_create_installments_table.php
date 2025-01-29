<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstallmentsTable extends Migration
{
    public function up()
    {
        Schema::create('installments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_batch_id'); // Foreign key to course_batches table
            $table->decimal('amount', 10, 2);             // Installment amount
            $table->integer('installment');                    // Installment 
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('course_batch_id')
                  ->references('id')
                  ->on('course_batches')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('installments');
    }
}
