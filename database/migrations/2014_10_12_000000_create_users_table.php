<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('user_id');
            $table->string('name', 250);
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('company', 250)->nullable();
            $table->string('address', 10)->nullable();
            $table->string('postal_code', 500)->nullable();
            $table->string('country', 50)->nullable();
            $table->string('state', 50)->nullable();
            $table->string('city', 50)->nullable(); 
            $table->string('role', 50)->default('subcriber');       
            $table->string('password');
            $table->string('image', 500)->nullable(); 
            $table->string('address', 500)->nullable(); 
            $table->string('postal_code', 10)->nullable(); 
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
