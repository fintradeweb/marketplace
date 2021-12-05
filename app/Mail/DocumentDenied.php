<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;

class DocumentDenied extends Mailable{

  use Queueable, SerializesModels;
  public $observation;
    
  public function __construct($observation){
    $this->observation = $observation;
  }
  
  public function build(){
    return $this->view('marketsend.documentdenied');
  }
}
