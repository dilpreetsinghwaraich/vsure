<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->increments('service_id');
            $table->string('service_title', 250)->nullable();
            $table->text('service_content')->nullable();
            $table->text('service_questions')->nullable();
            $table->text('service_short_info')->nullable();
            $table->text('service_features')->nullable();   
            $table->text('service_documents')->nullable();
            $table->text('service_process_results')->nullable();
            $table->text('service_packages')->nullable();
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
        Schema::dropIfExists('services');
    }
}
