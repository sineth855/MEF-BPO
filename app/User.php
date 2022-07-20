<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\User;
use DB;
class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id',
        'name',
        'username',
        'email',
        'title',
        'latin',
        'department',
        'duty',
        'entity',
        'position',
        'avatar',
        'gender',
        'dob',
        'telephone_1',
        'telephone_2',
        'password',
        'is_default',
    ];

    public static function getOfficerInfo($userId){
        $query = DB::table("incentive_officer as io")
                  ->Select("io.*")
                  ->Where("io.user_id", $userId)
                  ->Where('io.status', 1)
                  ->first();
        return $query;
    }

    public static function checkHasUser($username){
        $query = User::Where("username", $username)->first();
        $boolen = true;
        if($query){
            $boolen = true;
        }else{
            $boolen = false;
        }
        return $boolen;
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
