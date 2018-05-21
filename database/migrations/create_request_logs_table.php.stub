<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;

class CreateRequestLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ore_request_logs', function ($table) {
            $table->increments('id');
            $table->string('type');
            $table->string('url');
            $table->string('category')->default('default');
            $table->string('method')->nullable();
            $table->string('ip')->nullable();
            $table->longtext('request');
            $table->longtext('response');
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('ore_request_logs');
    }
}
