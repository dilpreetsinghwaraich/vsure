<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcessResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('process_results', function (Blueprint $table) {
            $table->increments('process_id');
            $table->string('process_title', 250)->nullable();
            $table->string('process_subtitle', 250)->nullable();
            $table->text('process_content')->nullable();
            $table->string('process_image', 250)->nullable();
            $table->text('process_terms')->nullable();
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
        Schema::dropIfExists('process_results');
    }
}
