<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Fightzone extends Migration
{
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('slug', 32);
            $table->timestamps();
        });

        Schema::create('alerts', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('class', 24);
            $table->text('routes')->nullable();
            $table->date('from_date');
            $table->date('to_date');
            $table->text('content_sv');
            $table->text('content_en');
            $table->timestamps();
        });

        Schema::create('events', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->unsignedInteger('activity_id')->index();
            $table->unsignedTinyInteger('dow');
            $table->time('from_time');
            $table->time('to_time');
            $table->boolean('is_enabled')->default(1);
            $table->boolean('is_open_mat')->default(0);
            $table->string('content_sv', 64)->nullable();
            $table->string('content_en', 64)->nullable();
            $table->timestamps();
        });

        Schema::create('payment_articles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('number');
            $table->integer('price');
            $table->text('name_en');
            $table->text('name_sv');
            $table->text('content_en');
            $table->text('content_sv');
            $table->boolean('active');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('prices', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->unsignedInteger('activity_id')->index();
            $table->unsignedInteger('adult_1_m')->nullable();
            $table->unsignedInteger('adult_6_m')->nullable();
            $table->unsignedInteger('adult_1_y')->nullable();
            $table->unsignedInteger('youth_1_m')->nullable();
            $table->unsignedInteger('youth_6_m')->nullable();
            $table->unsignedInteger('youth_1_y')->nullable();
            $table->timestamps();
        });

        Schema::create('texts', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('route', 64)->index();
            $table->string('name', 32)->index();
            $table->text('content_sv');
            $table->text('content_en');
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('activities');
        Schema::dropIfExists('alerts');
        Schema::dropIfExists('events');
        Schema::dropIfExists('prices');
        Schema::dropIfExists('texts');
        Schema::dropIfExists('users');
    }
}
