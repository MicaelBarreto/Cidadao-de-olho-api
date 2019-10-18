<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndenizacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indenizacaos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('data');
            $table->unsignedBigInteger('deputado_id');
            $table->foreign('deputado_id')->references('id')->on('deputados');
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
        Schema::dropIfExists('indenizacaos');
    }
}
