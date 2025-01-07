<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();  // Auto-incrementing ID
            $table->string('course_name');  // Course name
            $table->text('description');  // Course description
            $table->string('instructor');  // Instructor name
            $table->string('support_staff');  // Support staff name
            $table->timestamps();  // Automatically handles created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
