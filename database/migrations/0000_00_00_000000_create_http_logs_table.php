<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

class CreateHttpLogsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create(Config::get('amethyst.http-log.data.http-log.table'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('url');
            $table->string('method')->nullable();
            $table->string('ip')->nullable();
            $table->longtext('request')->nullable();
            $table->longtext('response')->nullable();
            $table->integer('status')->nullable();
            $table->integer('time')->default(0);
            $table->string('authenticable_type')->nullable();
            $table->integer('authenticable_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists(Config::get('amethyst.http-log.data.http-log.table'));
    }
}
