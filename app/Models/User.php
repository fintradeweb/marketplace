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
        'taxid',
        'datecompany',
        'contactname',
        'presidentname',
        'typeofbusiness',
        'phone',
        'country',
        'city',
        'state',
        'zipcode',
        'address',
        'cellphone',
        'website',
        'dba',
        'secretaryname',
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

    public static function existe_usuario($s_email) {
      $usuario = DB::select("call Get_existe_user(?)",[$s_email]);
      return $usuario[0];
    }
}
