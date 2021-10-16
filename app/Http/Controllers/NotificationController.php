<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class NotificationController extends Controller{
    
  public function __construct(){
    $this->middleware('auth');
  }

  public function index($type){
    $notifications = \App\Models\Notificationsend::notif_info(@Auth::user()->id);
    $arr_notification = ($type == "sent") ? $notifications[1] : $notifications[2];        
    return view('notification.index', [
      'notifications' => $arr_notification,
      'type' => $type
    ]);
  }

  public function create(){
        //
  }

  public function store(Request $request){
        //
  }

  public function show($type,$id){
    $notification = \App\Models\Notificationsend::notif_id($id);    
    if ($type == "received"){      
      $read = \App\Models\Notificationsend::read_notif($id);      
    }
    return view('notification.show', [
      'notification' => $notification[0],
      'type' => $type
    ]); 
  }

  public function edit($id){
        //
  }

  public function update(Request $request, $id){
        //
  }

  public function destroy($id){
        //
  }
}
