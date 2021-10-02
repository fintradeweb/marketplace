<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NotificationSendTable extends Migration{
    
  public function up(){
    Schema::create('notification_send', function (Blueprint $table) {
      $table->id();
      $table->timestamps();
      $table->text('description');
      $table->string('type_not');
      $table->unsignedBigInteger('user_id')->comment('user borrower');  
      $table->unsignedBigInteger('send_by')->comment('user lender');                                 
      $table->foreign('user_id')->references('id')->on('users');
      $table->foreign('send_by')->references('id')->on('users');
    });
  }

  public function down(){
    Schema::dropIfExists('notification_send');
  }
}
