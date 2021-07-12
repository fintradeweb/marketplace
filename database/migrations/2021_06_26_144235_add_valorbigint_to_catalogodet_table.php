<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddValorbigintToCatalogodetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('catalogodet', function (Blueprint $table) {
            $table->bigInteger('valor_bigint');
            $table->bigInteger('valor_bigint2');
            $table->bigInteger('valor_bigint3');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('catalogodet', function (Blueprint $table) {
            //
        });
    }
}
