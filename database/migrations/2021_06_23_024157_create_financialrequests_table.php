<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancialrequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financialrequests', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->double('avg_montky_sales');
            $table->integer('ams_how_clients');
            $table->boolean('has_applicant');
            $table->double('estimated_montly_financing');
            $table->integer('emf_number_clients');
            $table->boolean('po_finance');
            $table->boolean('in_finance');
            $table->boolean('lawsuits_pending');
            $table->boolean('receivable_finance');
            $table->integer('rf_when_with_whom');
            $table->boolean('credit_insurance_policy');
            $table->integer('cip_when_with_whom');
            $table->boolean('declared_bank_ruptcy');

            
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
        Schema::dropIfExists('financialrequests');
    }
}
