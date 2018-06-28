<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

class CreateRequestLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Config::get('ore.request_logger.table'), function ($table) {
            $table->increments('id');
            $table->string('type');
            $table->string('url');
            $table->string('category')->default('default');
            $table->string('method')->nullable();
            $table->string('ip')->nullable();
            $table->longtext('request');
            $table->longtext('response');
            $table->integer('status')->nullable();
            $table->integer('time')->default(0);
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
        Schema::dropIfExists(Config::get('ore.request_logger.table'));
    }
}
