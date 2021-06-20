<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;


class MarketReceived extends Mailable
{
    use Queueable, SerializesModels;
    public $usuarioCall;

    
    public function __construct($usuario)
    {
        $this->usuarioCall = $usuario;
    }

    
    public function build()
    {
        return $this->view('marketsend.marketsend');
    }
}
