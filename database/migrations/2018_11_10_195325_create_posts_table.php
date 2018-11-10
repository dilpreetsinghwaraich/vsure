<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('post_id');
            $table->integer('user_id');
            $table->string('post_title', 500)->nullable();
            $table->string('post_slug', 500)->nullable();
            $table->text('post_excerpt')->nullable();
            $table->longText('post_content')->nullable();
            $table->string('image', 500)->nullable();
            $table->string('post_type', 30)->nullable();
            $table->integer('post_parent')->nullable();
            $table->string('post_parent_type', 30)->nullable();
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
        Schema::dropIfExists('posts');
    }
}
