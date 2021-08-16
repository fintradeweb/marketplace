<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessinformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businessinformations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('company_name');
            $table->date('date_company');
            $table->string('type_business');
            $table->string('contact_name');
            $table->string('zip');
            $table->string('phone');
            $table->string('president_name');
            $table->string('address');
            $table->string('ruc_tax')->unique();
            $table->string('website')->nullable();
            $table->string('secretary_name')->nullable();
            $table->string('dba')->nullable();
            $table->string('cell_phone')->nullable();

            
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('state_id');
            $table->unsignedBigInteger('city_id');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('country_id')->references('id')->on('catalogodet');
            $table->foreign('city_id')->references('id')->on('catalogodet');
            $table->foreign('state_id')->references('id')->on('catalogodet');
            

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('businessinformations');
    }
}
