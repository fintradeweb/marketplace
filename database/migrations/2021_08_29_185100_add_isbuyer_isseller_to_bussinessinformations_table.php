<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsbuyerIssellerToBussinessinformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('businessinformations', function (Blueprint $table) {
            $table->boolean('is_buyer')->default(0);
            $table->boolean('is_seller')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('businessinformations', function (Blueprint $table) {
            //
        });
    }
}
