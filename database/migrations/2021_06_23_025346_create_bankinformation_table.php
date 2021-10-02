<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankinformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bankinformations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('bank_name');
            $table->string('account_same_swift');
            $table->string('account_number');
            $table->string('aba_routing');
            $table->string('bank_adress');
            $table->string('telephone');
            $table->string('account_officer');
            

            
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
        Schema::dropIfExists('bankinformations');
    }
}
