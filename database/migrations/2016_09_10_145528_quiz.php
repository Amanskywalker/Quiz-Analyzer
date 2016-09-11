<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Quiz extends Migration
{
    private $NumberOfQuestions=20;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('questions', function (Blueprint $table) {
          $table->increments('id');
          $table->string('key')->unique();
          for ($i=1; $i <= $this->NumberOfQuestions ; $i++) {
            $table->string('question'.$i);
          }
          $table->timestamps();
      });

      Schema::create('submissions', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('uid')->comment('User id')->references('id')->on('users');
          $table->string('key')->references('key')->on('questions');
          for ($i=1; $i <= $this->NumberOfQuestions ; $i++) {
            $table->string('question'.$i)->default('0')->nullable();
          }
          $table->timestamps();
      });

      Schema::create('scores', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('uid')->comment('User id')->references('id')->on('users');
          $table->string('key')->references('key')->on('questions');
          $table->integer('correct');
          $table->integer('incorect');
          $table->integer('score');
          $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('questions');
        Schema::drop('submissions');
    }
}
