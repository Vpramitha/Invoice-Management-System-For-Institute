<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id(); // This will create an auto-incrementing ID field
            $table->string('name'); // Student name
            $table->string('email'); // Student email (unique)
            $table->string('course'); // Course the student is enrolled in
            $table->string('batch'); // Batch the student is assigned to
            $table->decimal('registration_fee', 8, 2); // Registration fee
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
        Schema::dropIfExists('students');
    }
}
