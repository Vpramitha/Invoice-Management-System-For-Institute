<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentCourseBatchTable extends Migration
{
    public function up()
    {
        Schema::create('student_course_batches', function (Blueprint $table) {
            $table->id(); // Auto-incremented ID
            $table->unsignedBigInteger('student_id'); // Foreign key to the students table
            $table->unsignedBigInteger('course_batch_id'); // Foreign key to the course_batches table
            $table->decimal('registration_fee', 10, 2); // Registration fee
            $table->boolean('full_payment')->default(false); // Full payment status (true/false)
            $table->timestamps(); // Created at and updated at timestamps

            // Foreign key constraints to ensure referential integrity
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('course_batch_id')->references('id')->on('course_batches')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('student_course_batches');
    }
}
