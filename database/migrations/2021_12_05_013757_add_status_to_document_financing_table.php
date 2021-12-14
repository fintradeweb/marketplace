<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToDocumentFinancingTable extends Migration{

  public function up(){
    Schema::table('document_financing', function (Blueprint $table) {
      $table->enum('status',['in review', 'denied','approved','funded'])->default('in review');
    });
  }

  public function down(){
    Schema::table('document_financing', function (Blueprint $table) {
      $table->dropColumn('status');
    });
  }
}
