<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->increments('package_id');
            $table->string('package_title', 250)->nullable();
            $table->text('package_content')->nullable();
            $table->text('package_terms')->nullable();
            $table->bigInteger('regular_price');
            $table->bigInteger('sale_price');
            $table->date('discount_start');
            $table->date('discount_end');
            $table->integer('status');
            $table->integer('is_featured');
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
        Schema::dropIfExists('packages');
    }
}
