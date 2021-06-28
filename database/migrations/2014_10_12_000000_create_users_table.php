<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id', 20);
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('email', 150)->unique();
            $table->date('dob')->nullable();
            $table->string('password', 200)->nullable();
            $table->string('phone', 20)->unique()->nullable();
            $table->foreignId('create_by', 20)->nullable();
            $table->foreignId('update_by', 20)->nullable();
            $table->tinyInteger('status')->default('1');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
