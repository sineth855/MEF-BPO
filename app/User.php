<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Settings\Entity;
use App\Models\Settings\Role;
use Laravel\Passport\HasApiTokens;
use App\User;
use DB;
use Auth;

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
        'entity_id',
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
        'is_delete',
        'is_active',
    ];

    public function Entity(){
      return $this->belongsTo(Entity::class, 'entity_id');
    }

    public function Role(){
        return $this->belongsTo(Role::class,'role_id');
    }

    public static function getOfficerInfo($userId){
        $query = DB::table("incentive_officer as io")
                  ->Select("io.*")
                  ->Where("io.user_id", $userId)
                  ->Where('io.status', 1)
                  ->first();
        return $query;
    }

    public static function getUsers($filter){
        $data = array();
        $query = User::orderBy($filter["sort"], $filter["order"]);
        $whereClause = $query;
        $whereClause->where("is_active", 1);
        $whereClause->where("is_default", 0);
        if(Auth::user()->entity_id !=0 || Auth::user()->entity_id !=null){
            $whereClause->where("entity_id", Auth::user()->entity_id);
        }
        $whereClause->offset(($filter["page_number"] - 1) * $filter["limit"]);       
        $whereClause->limit($filter["limit"]);

        if($filter["search_field"]){
            $arraySingle = call_user_func_array('array_merge', $filter["search_field"]);
            $dataFields = $arraySingle;
            if (array_key_exists('role_id', $dataFields)) {
                $whereClause->Where("role_id", 'Like', '%'.$dataFields["role_id"]["value"].'%');
            }
            if (array_key_exists('entity_id', $dataFields)) {
                $whereClause->Where("entity_id", 'Like', '%'.$dataFields["entity_id"]["value"].'%');
            }
            if (array_key_exists('username', $dataFields)) {
                $whereClause->Where("username", 'Like', '%'.$dataFields["username"].'%');
            }
            if (array_key_exists('email', $dataFields)) {
                $whereClause->Where("email", 'Like', '%'.$dataFields["email"].'%');
            }
            if (array_key_exists('gender', $dataFields)) {
                $whereClause->Where("gender", 'Like', '%'.$dataFields["gender"].'%');
            }
            if (array_key_exists('title', $dataFields)) {
                $whereClause->Where("title", 'Like', '%'.$dataFields["title"].'%');
            }
        }
        $queryResult = collect($whereClause->get());
        foreach($queryResult as $row){
            $data[] = array(
                "id" => $row->id,
                "role_id" => array(
                    "label" => $row->Role?$row->Role->name:null,
                    "value" => $row->Role?$row->Role->id:null
                ),
                "entity_id" => $row->Role?$row->Role->entity_id:null,
                "entity" => $row->entity,//$row->Entity->code.'-'.$row->Entity->name_en,
                "role" => $row->Role?$row->Role->name:null,
                "name" => $row->name,
                "username" => $row->username,
                "email" => $row->email,
                "title" => $row->title,
                "latin" => $row->latin,
                "department" => $row->department,
                "duty" => $row->duty,
                "position" => $row->position,
                "avatar" => $row->avatar,
                "gender" => $row->gender,
                "dob" => $row->dob,
                "telephone_1" => $row->telephone_1,
                "telephone_2" => $row->telephone_2,
                // "password" => $row->password,
                "is_default" => $row->is_default,
            );
        }

        return $data;
    }

    public static function getCount($filter){
        $query = User::orderBy($filter["sort"], $filter["order"]);
        $whereClause = $query;
        $whereClause->where("is_active", 1);
        $whereClause->where("is_default", 0);
        if(Auth::user()->entity_id !=0 || Auth::user()->entity_id !=null){
            $whereClause->where("entity_id", Auth::user()->entity_id);
        }
        if($filter["search_field"]){
          $arraySingle = call_user_func_array('array_merge', $filter["search_field"]);
          $dataFields = $arraySingle;
          if(array_key_exists('role_id', $dataFields)) {
            $whereClause->orWhere("id", $dataFields["role_id"]["value"]);
          }
          if(array_key_exists('entity_id', $dataFields)) {
            $whereClause->Where("id", $dataFields["entity_id"]["value"]);
          }
        }
        $total = collect($whereClause->count());
        return $total;
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
