<?php

namespace App\Http\Controllers\Modules\BudgetArrangement;
use App\Models\Settings\Entity;
use App\Http\Controllers\Controller;
use App\Models\Modules\BudgetArrangement\PBExpenditure;
use Illuminate\Http\Request;
use Auth;
use DB;
use CommonService;

class PBExpenditureController extends Controller
{
    protected $db_table;
    public $path = "admin/modules/entry_pb_expenditure";

    public function __construct()
    {
        $this->middleware('auth');
        $this->view_title = $this->path.'.entry_title';
        $this->db_table = new PBExpenditure;
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
        
        $entities = Entity::getEntities();
        
        $data = array(
            "data_fields" => $this->dataFields(),
            "data" => PBExpenditure::getExpenditures($filter),
            "entity_id" => $entities,
            // "entity_member_id" => $entity_members,
            "limit" => LIMIT,
            "total" => $this->db_table::count()
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
            $message = trans('common.message_error');
        }
        $data = array(
            "success" => $boolen,
            "message" => $message,
            "data" => $this->db_table::findOrFail($id)
        );
        return response()->json($data, $status);
    }

    public function dataForm($input){
        $dataFields = array(
            "code" => isset($input["code"])?$input["code"]:"",
            "sub_program_id" => isset($input[0]["sub_program_id"])?$input[0]["sub_program_id"]:null,
            "entity_id" => isset($input[3]["entity_id"])?$input[3]["entity_id"]:null,
            "entity_member_id" => isset($input[4]["entity_member_id"])?$input[4]["entity_member_id"]:null,
            "name_en" => isset($input[1]["name_en"])?$input[1]["name_en"]:null,
            "name_kh" => isset($input[2]["name_kh"])?$input[2]["name_kh"]:null,
            "remark" => isset($input[6]["remark"])?$input[6]["remark"]:null,
            "order_level" => isset($input[5]["order_level"])?$input[5]["order_level"]:0,
            "is_active" => isset($input[7]["is_active"])?$input[7]["is_active"]:1,
            "created_by" => Auth::user()->id
        );
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
        $table = $this->db_table::where('id', $id)->delete();
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