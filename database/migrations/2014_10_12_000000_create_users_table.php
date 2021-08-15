<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->string("taxid")->unique()->nullable();
            $table->string("datecompany")->nullable();
            $table->string("contactname")->nullable();
            $table->string("presidentname")->nullable();
            $table->string("typeofbusiness")->nullable();
            $table->string("phone")->nullable();
            $table->string("country")->nullable();
            $table->string("city")->nullable();
            $table->string("state")->nullable();
            $table->string("zipcode")->nullable();
            $table->string("address")->nullable();
            $table->string("cellphone")->nullable();
            $table->string("website")->nullable();
            $table->string("dba")->nullable();
            $table->string("secretaryname")->nullable();
            $table->integer("status")->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
