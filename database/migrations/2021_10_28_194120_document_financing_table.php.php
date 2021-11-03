<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DocumentFinancingTable extends Migration{

  public function up(){
    Schema::create('document_financing', function (Blueprint $table) {
      $table->id();
      $table->timestamps();
      $table->string('type_doc');  
      $table->text('aditional');
      $table->string('url_doc');      
      $table->date('creation_date');      
      $table->date('due_date');      
      $table->double('amount');      
      $table->unsignedBigInteger('user_id');        
      $table->foreign('user_id')->references('id')->on('users');      
    });
  }
    
  public function down(){
    Schema::dropIfExists('document_financing');
  }
}
