<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('last_name', 137);
            $table->string('first_name', 137);
            $table->string('avatar', 255);
            $table->tinyInteger('gender');
            $table->date('birthdate');

            $table->string('hometown');
            $table->string('phone',13);
            $table->string('email');
            $table->bigInteger('faculty_id')->unsigned();
            $table->longText('description');

            $table->timestamps();

            $table->foreign('faculty_id')->references('id')->on('faculties')->onDelete('cascade');
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
};
