<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseBatchesTable extends Migration
{
    public function up()
    {
        Schema::create('course_batches', function (Blueprint $table) {
            $table->id(); // Auto-generated ID
            $table->unsignedBigInteger('course_id'); // Foreign key to courses table
            $table->string('batch'); // Batch name or identifier
            $table->decimal('course_price', 10, 2); // Price of the course
            $table->decimal('registration_fee', 10, 2); // Registration fee
            $table->text('description')->nullable(); // Description (nullable)
            $table->date('start_date')->nullable(); // Start date (nullable)
            $table->string('start_month')->nullable(); // Start month (nullable)
            $table->timestamps(); // Created at and updated at timestamps

            // Foreign key constraint to ensure referential integrity
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('course_batches');
    }
}
