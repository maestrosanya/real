<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('regions')) {
            return;
        }
        Schema::create('regions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug');
            $table->integer('parent_id')->nullable()->references('id')->on('regions')->onDelete('cascade');
            $table->timestamps();

            $table->index(['id', 'parent_id']);
            $table->unique('slug');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('regions');
    }
}
