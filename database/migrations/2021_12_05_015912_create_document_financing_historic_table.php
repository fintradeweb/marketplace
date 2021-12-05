<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentFinancingHistoricTable extends Migration{
    
  public function up(){
    Schema::create('document_financing_historic', function (Blueprint $table) {
      $table->id();
      $table->timestamps();
      $table->integer('type_document')->comment('1-PO 2-Invoice'); 
      $table->text('observation')->nullable();
      $table->double('amount')->nullable();
      $table->enum('status',['in review', 'denied', 'funded'])->default('in review');
      $table->unsignedBigInteger('lender_id');  
      $table->foreign('lender_id')->references('id')->on('users'); 
      $table->unsignedBigInteger('document_id');  
      $table->foreign('document_id')->references('id')->on('document_financing'); 
      $table->unsignedBigInteger('user_id');        
      $table->foreign('user_id')->references('id')->on('users'); 
    });
  }

  public function down(){
    Schema::dropIfExists('document_financing_historic');
  }
}
