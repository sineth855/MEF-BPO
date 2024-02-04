<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Settings\Role;
use App\Models\Settings\Title;
use App\Models\Settings\Entity;
use App\Models\Settings\Position;
use Illuminate\Http\Request;
use Auth;
use DB;
use CommonService;

class UserController extends Controller
{   
    protected $db_table;
    public $path = "admin/setting";

    public function __construct()
    {
        $this->middleware('auth');
        $this->view_title = $this->path.'.entry_user';
        $this->db_table = new User;
        $this->lang_path = $this->path;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $input = $request->all();
        $dataFields = $this->dataFields();
        $filter = CommonService::getFilter($input);
        // dd($filter);
        
        $genders = array(
            [
                "label" => "ប្រុស",
                "value" => "ប្រុស"
            ],[
                "label" => "ស្រី",
                "value" => "ស្រី"
            ],
        );
        $entities = Entity::getEntities();
        $roles = Role::getRoleValues($filter);
        $titles = Title::getTitles();
        $positions = Position::gePositionValues();
        
        $data = array(
            "entity_id" => $entities,
            "role_id" => $roles,
            "gender" => $genders,
            "title" => $titles,
            "position" => $positions,
            "data_fields" => $this->dataFields(),
            "data" => $this->db_table::getUsers($filter),
            "limit" => config_limit,
            "total" => User::getCount($filter)
        );
        return response()->json($data);

        // $input = $request->all();
        // $filter = array(
        //     "offset" => isset($input["offset"]) ? $input["offset"] : config_offset,
        //     "limit" => isset($input["limit"]) ? $input["limit"] : config_limit,
        //     "sort" => isset($input["sort"]) ? $input["sort"] : config_sort,
        //     "order" => isset($input["order"]) ? $input["order"] : config_order
        // );
        // $table = $this->db_table::orderBy($filter["sort"], $filter["order"])
        //                         ->offset($filter["offset"])
        //                         ->limit($filter["limit"])
        //                         ->where("is_default", 0)
        //                         ->whereNotNull("name")
        //                         ->whereNotIn("role_id", [4])
        //                         ->get();
        // $data = array(
        //     "data" => $table,
        //     "total" => count($table)
        // );
        // return response()->json($data);
    }

    public function dataFields(){
        // Loop Data Field From Table to put in array for mapping data field to search data table
        $data["tables"] = DB::select('show columns from '.env("DB_PREFIX").($this->db_table)->getTable());
        $str = "";
        for($i=0; $i < count($data["tables"]); $i++){
            $str .= $data["tables"][$i]->Field.",";
        }
        $newArr = explode(",", $str);
        array_pop($newArr);
        $dataFields = $newArr;
        return $dataFields;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $dataFields = $this->dataForm($input);
        $table = $this->db_table::create($dataFields);
        if($table){
            $status = 200;
            $boolen = true;
            $message = trans('common.msg_save_successfully');
        }else{
            $status = 500;
            $boolen = false;
            $message = trans('common.error_msg');
        }
        $data = array(
            "success" => $boolen,
            "message" => $message,
            "data" => $table,
        );
        return response()->json($data, $status);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $table = $this->db_table::find($id);
        $data = array(
            "data" => $table
        );
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function getProfile(){
        $id = Auth::user()->id;
        $table = $this->db_table::find($id);
        $data = array(
            "data" => $table,
            "incentiveInfo" => $this->db_table::getOfficerInfo($id)
        );
        return response()->json($data);
    }

    public function updateProfile(Request $request){
        $id = Auth::user()->id;
        $data = $request->all();
        $table = $this->db_table::where('id', $id)->update([
            "name" => $data["name"],
            "gender" => $data["gender"],
            "dob" => $data["dob"],
            "email" => $data["email"],
            "avatar" => $data["avatar"]
        ]);
        $data = array(
            "data" => $data
        );
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $dataFields = $this->dataForm($input);
        $table = $this->db_table::where('id', $id)->update($dataFields);
        if($table){
            $status = 200;
            $boolen = true;
            $message = trans('common.msg_update_successfully');
        }else{
            $status = 500;
            $boolen = false;
            $message = trans('common.error_msg');
        }
        $data = array(
            "success" => $boolen,
            "message" => $message,
            "data" => $this->db_table::findOrFail($id)
        );
        return response()->json($data, $status);
        // $input = $request->all();
        // $input["modified_by"] = Auth::user()->id;
        // if(isset($input["password"]) && $input["password"] != ''){
        //     $input["password"] = bcrypt($input["password"]);
        // }
        // $table = $this->db_table::where('id', $id)->update($input);
        // if($table){
        //     $status = 200;
        //     $boolen = true;
        //     $message = trans('title.message_update');
        // }else{
        //     $status = 500;
        //     $boolen = false;
        //     $message = trans('title.message_error');
        // }
        // $data = array(
        //     "success" => $boolen,
        //     "message" => $message,
        //     "data" => $this->db_table::findOrFail($id)
        // );
        // return response()->json($data, $status);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $table = $this->db_table::where('id', $id)->update([
            "is_delete" => 1
        ]);
        if($table){
            $status = 200;
            $boolen = true;
            $message = trans('title.message_delete');
        }else{
            $status = 500;
            $boolen = false;
            $message = trans('title.message_error');
        }
        $data = array(
            "success" => $boolen,
            "message" => $message
        );
        return response()->json($data, $status);
    }

    public function dataForm($input){
        $arr = $input;
        $push_array = array_merge(array(["created_by" => Auth::user()->id]));
        $arraySingle = array_merge($arr, $push_array);
        $result = call_user_func_array('array_merge', $arraySingle);
        $dataFields = $result;
        return $dataFields;
    }
}
