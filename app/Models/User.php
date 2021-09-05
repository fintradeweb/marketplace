<?php
namespace App\Models;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

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
}
