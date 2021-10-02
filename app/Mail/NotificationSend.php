<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;

class NotificationSend extends Mailable{

  use Queueable, SerializesModels;
  public $description;
    
  public function __construct($description){
    $this->description = $description;
  }
  
  public function build(){
    return $this->view('marketsend.notificationsend');
  }
}
