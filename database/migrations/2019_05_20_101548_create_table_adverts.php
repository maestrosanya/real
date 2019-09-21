<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAdverts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adverts', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('title', 255);
            $table->text('content');
            $table->integer('price');
            $table->string('phone');
            $table->string('address')->nullable();
            $table->text('reason_rejection')->nullable();

            //

            $table->integer('category_id')->unsigned()->references('id')->on('categories');
            $table->integer('city_id')->unsigned()->references('id')->on('cities');
            $table->integer('user_id')->unsigned()->references('id')->on('users')->onDelete('cascade');


            $table->index(['category_id', 'city_id', 'user_id']);


            // Statuses

            $table->string('status');

            // date
            $table->timestamps();
            $table->timestamp('published_at')->nullable();
            $table->timestamp('publication_expiration')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adverts');
    }
}
