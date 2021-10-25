<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Auth;
use App\Models\NotificationSend;

class NotificationController extends Controller{
    
  public function __construct(){
    $this->middleware('auth');
  }

  public function index($type){
    $notifications = \App\Models\NotificationSend::notif_info(@Auth::user()->id);
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
    $validatedData = $request->validate([
      'observation' => 'required',      
    ]);

    $notification = new NotificationSend; 
    $notification->description = $request->observation;
    $notification->send_by = @Auth::user()->id;
    $notification->user_id = $request->user_id;
    $notification->type_not = "replynotification";
    $rs = $notification->save();

    if ($rs){
      Mail::to("ffueltala@gmail.com")->send(new \App\Mail\NotificationSend($notification->observation));
      return redirect('/notification/sent')->with('status', 'The notification was send succesfully!');
    }
    else{
      return redirect('/notification/sent')->withErrors('There was an error!');  
    }
  }

  public function show($type,$id){
    $notification = \App\Models\NotificationSend::notif_id($id);    
    if ($type == "received"){      
      $read = \App\Models\NotificationSend::read_notif($id);      
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
