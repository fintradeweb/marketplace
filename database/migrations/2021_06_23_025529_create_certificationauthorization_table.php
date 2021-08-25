<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificationauthorizationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificationauthorizations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->boolean('approved_agreed');
            $table->string('name');
            $table->string('title');
            
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('client_id');
           
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('client_id')->references('id')->on('clients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('certificationauthorizations');
    }
}
