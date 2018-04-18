<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUrlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('urls', function (Blueprint $table) {
            //$table->increments('id');
            $table->string('url',255)->index();
            $table->string('short',12);
            $table->date('expired')->index();
            $table->timestamp('created_at');
            $table->primary('short');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('urls');
    }
}
