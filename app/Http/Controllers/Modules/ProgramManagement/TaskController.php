<?php

namespace App\Http\Controllers\Modules\ProgramManagement;

use App\Http\Controllers\Controller;
use App\Models\Modules\ProgramManagement\ClusterActivity;
use App\Models\Modules\ProgramManagement\Activity;
use App\Models\Modules\ProgramManagement\Task;
use App\Models\Settings\Entity;
use App\Models\Settings\EntityMember;
use Illuminate\Http\Request;
use Auth;
use DB;
use CommonService;

class TaskController extends Controller
{
    protected $db_table;
    public $path = "admin/modules/task";

    public function __construct()
    {
        $this->middleware('auth');
        $this->view_title = $this->path.'.entry_title';
        $this->db_table = new Task;
        $this->lang_path = $this->path;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    public function index(Request $request)
    {
        $input = $request->all();
        $dataFields = $this->dataFields();
        $filter = CommonService::getFilter($input);
        
        $clusterActivities = ClusterActivity::getClusterActs($filter);
        $activities = [];
        $entities = [];
        $entity_members = [];

        $data = array(
            "data_fields" => $this->dataFields(),
            "data" => $this->db_table::getTaskByAct($filter),
            "cluster_activity_id" => $clusterActivities,
            "activity_id" => $activities,
            "entity_id" => $entities,
            "entity_member_id" => $entity_members,
            "limit" => config_limit,
            "total" => Activity::getCount($filter)
        );
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            "data" => $table,
        );
        return response()->json($data);
    }

    function getTaskDetail(Request $request){
        $input = $request->all();
        // dd($input);
        // $dataFields = $this->dataFields();
        // $filter = CommonService::getFilter($input);
        // dd($filter);
        $accountGroups = [];
        $accounts = [];
        $subAccounts = [];
        $data = array(
            "data" => $this->db_table::getTaskDetail($input),
            "account_group_id"=> $accountGroups,
            "account_id"=> $accounts,
            "sub_account_id"=> $subAccounts,
            "limit" => config_limit,
            "total" => 0//Activity::getCount($filter)
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
    }

    public function dataForm($input){
        $arr = $input;
        $code = rand(10,100);
        $push_array = array("code" => $code , "created_by" => Auth::user()->id, "updated_by" => Auth::user()->id);
        array_push($arr, $push_array);
        $arraySingle = call_user_func_array('array_merge', $arr);
        $dataFields = $arraySingle;
        return $dataFields;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $table = $this->db_table::where('id', $id)->update(["is_delete" => 1]);
        if($table){
            $status = 200;
            $boolen = true;
            $message = trans('common.msg_delete_successfully');
        }else{
            $status = 500;
            $boolen = false;
            $message = trans('common.error_msg');
        }
        $data = array(
            "success" => $boolen,
            "message" => $message
        );
        return response()->json($data, $status);
    }
}