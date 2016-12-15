<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('comment', function (Blueprint $table) {
            $table->increments('id');
            $table->string('comment');
            $table->integer('reply_to_uid');//->unique();
            $table->integer('uid');
            $table->integer('zan');
            $table->integer('itemid');
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
        Schema::drop('comment');
    }
}
