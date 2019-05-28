<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAdvertAttrValue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advert_attr_value', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('advert_id')->unsigned()->references('id')->on('adverts')->onDelete('cascade');
            $table->integer('attribute_id')->unsigned()->references('id')->on('attributes')->onDelete('cascade');
            $table->string('value');

            $table->index(['advert_id', 'attribute_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advert_attr_value');
    }
}
