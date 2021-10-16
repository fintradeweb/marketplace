<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;

class CreditEdited extends Mailable{

  use Queueable, SerializesModels;
  public $creditpo;
  public $creditinvoice;
    
  public function __construct($creditpo,$creditinvoice){
    $this->creditpo = $creditpo;
    $this->creditinvoice = $creditinvoice;
  }
  
  public function build(){
    return $this->view('marketsend.creditmodified');
  }
}
