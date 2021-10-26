<?php
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use DB;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'email',
        'password',
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function existe_usuario($s_email, $s_token) {

       /* $usuario= DB::select("call Get_existe_user(?,?)",[$s_email,$s_token]);
        return $usuario;*/

        $params = [$s_email,$s_token];
        return User::CallRaw('Get_existe_user',$params );
    }

    public static function CallRaw($procName, $parameters = null, $isExecute = false)
    {
        $syntax = '';
        for ($i = 0; $i < count($parameters); $i++) {
            $syntax .= (!empty($syntax) ? ',' : '') . '?';
        }
        $syntax = 'CALL ' . $procName . '(' . $syntax . ');';

        $pdo = DB::connection()->getPdo();
        $pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, true);
        $stmt = $pdo->prepare($syntax,[\PDO::ATTR_CURSOR=>\PDO::CURSOR_SCROLL]);
        for ($i = 0; $i < count($parameters); $i++) {
            $stmt->bindValue((1 + $i), $parameters[$i]);
        }
        $exec = $stmt->execute();
        if (!$exec) return $pdo->errorInfo();
        if ($isExecute) return $exec;

        $results = [];
        do {
            try {
                $results[] = $stmt->fetchAll(\PDO::FETCH_OBJ);
            } catch (\Exception $ex) {

            }
        } while ($stmt->nextRowset());


        if (1 === count($results)) return $results[0];
        return $results;
    }


  public static function getUsersByRol($rolid,$estado, $fecha_inicio, $fecha_fin, $ruc, $orden) {
    $arr_users = DB::select("call Get_users_roles (?,?,?,?,?,?)",[ $rolid ,$estado, $fecha_inicio, $fecha_fin, $ruc, $orden]);
    return $arr_users;
  }

  public static function update_user_admin_super($request,$id) {
    $error=0;
    $msg= "";
    $status = 0;
    if(!empty($request->input('status'))){
      $status = 1;
    }
    $clave2 = "MARKET" .  Str::random(5) . "PLACE" . date('His');
    $clave = Hash::make($clave2);
    $result = DB::select('call Update_users_admin_super(?,?,?,?,?,?,@msg,@error)',
                [
                    $id,
                    $request->input('rol_id'),
                    $clave ,
                    $request->input('email'),
                    $request->input('name'),
                    $status/*,
                    $msg,
                    $error*/
                ]);
    $result[1] =  $clave2;
    return $result[0];
  }

  public static function create_user_admin_super($request) {
    $error=0;
    $msg= "";
    $clave2 = "MARKET" .  Str::random(5) . "PLACE" . date('His');
    $clave = Hash::make($clave2);
    $result = DB::select('call Create_users_admin_super(?,?,?,?,@msg,@error)',
                [
                    $request->input('rol_id'),
                    $clave ,
                    $request->input('email'),
                    $request->input('name')/*,
                    $msg,
                    $error*/
                ]);
    $result[1] =  $clave2;
    return $result;
  }

  public static function credit_info($user_id) {
    $params = [$user_id];
    return User::CallRaw('Get_info_credit',$params );
  }

  public static function notif_info($user_id) {
    $params = [$user_id];
    return User::CallRaw('Get_info_notifications',$params );
  }

}
