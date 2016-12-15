<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('item', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('seller');//->unique();
            $table->float('price');
            $table->string('desc');
            $table->string('picture');
            $table->string('zan');
            
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
        Schema::drop('item');
    }
}
