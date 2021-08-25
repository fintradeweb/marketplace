<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyValorbigintToCatalogodetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('catalogodet', function (Blueprint $table) {
            $table->bigInteger('valor_bigint')->default(0)->change();
            $table->bigInteger('valor_bigint2')->default(0)->change();
            $table->bigInteger('valor_bigint3')->default(0)->change();
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
