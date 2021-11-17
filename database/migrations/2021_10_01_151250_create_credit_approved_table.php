<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditApprovedTable extends Migration{
  
  public function up(){
    Schema::create('credit_approved', function (Blueprint $table) {
      $table->id();
      $table->timestamps();
      $table->double('credit_line');
      $table->double('advance');
      $table->double('maximum_amount');
      $table->integer('deadline');
      $table->double('interest_rate')->nullable();
      $table->integer('type_document')->comment('1-PO 2-Invoice');
      $table->unsignedBigInteger('user_id')->comment('user borrower');
      $table->unsignedBigInteger('approved_by')->comment('user lender');
      $table->foreign('user_id')->references('id')->on('users');
      $table->foreign('approved_by')->references('id')->on('users');
    });
  }

  public function down(){
    Schema::dropIfExists('credit_approved');
  }
}
