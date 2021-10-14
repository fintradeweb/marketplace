<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class NotificationSend extends Model{

  protected $table = 'notification_send';

  public static function notif_info($user_id) {
    $params = [$user_id];
    return User::CallRaw('Get_info_notifications',$params );
  }

  public static function notif_id($id) {
    $notification = DB::select("call Get_notification(?)",[$id]);
    return $notification;
  }

  public static function read_notif($notif_id) {
     $result = DB::select('call Update_read_notification(?,@error,@msg)',
                  [
                    $notif_id
                  ]);
      return $result[0];
  }
}
