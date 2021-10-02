<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditDeniedTable extends Migration{
    
  public function up(){
    Schema::create('credit_denied', function (Blueprint $table) {
      $table->id();
      $table->timestamps();
      $table->text('observation');
      $table->unsignedBigInteger('user_id')->comment('user borrower');  
      $table->unsignedBigInteger('denied_by')->comment('user lender');                                 
      $table->foreign('user_id')->references('id')->on('users');
      $table->foreign('denied_by')->references('id')->on('users');
    });
  }

  public function down(){
    Schema::dropIfExists('credit_denied');
  }
}
