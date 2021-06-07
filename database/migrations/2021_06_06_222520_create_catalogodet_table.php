<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatalogodetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalogodet', function (Blueprint $table) {
            $table->id();
            
            $table->string('valorstring');
            $table->double('valordouble', 15, 8)->nullable();
            $table->integer('valorint')->nullable();

            $table->string('valorstring2')->nullable();
            $table->double('valordouble2', 15, 8)->nullable();
            $table->integer('valorint2')->nullable();

            $table->string('valorstring3')->nullable();
            $table->double('valordouble3', 15, 8)->nullable();
            $table->integer('valorint3')->nullable();
            
            $table->unsignedBigInteger('catalogocab_id');

          
            $table->foreign('catalogocab_id')->references('id')->on('catalogocab');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catalogodet');
    }
}
