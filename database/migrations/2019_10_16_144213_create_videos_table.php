<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('title',20);//标题
	        $table->string('preview',255);//预览图地址
            $table->string('introduce',200);//简介
            $table->tinyInteger('iscommend');//是否推荐
            $table->tinyInteger('ishot');//是否热门
            $table->integer('click');//点击数

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
}
