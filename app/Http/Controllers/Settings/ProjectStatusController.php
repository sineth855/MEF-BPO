<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Settings\ProjectStatus;
use Illuminate\Http\Request;
use Auth;
use DB;

class ProjectStatusController extends Controller
{
    protected $db_table;
    public $path = "admin/setting";

    public function __construct()
    {
        $this->middleware('auth');
        $this->view_title = $this->path.'.entry_account_title';
        $this->db_table = new ProjectStatus;
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
        $filter = array(
            // "offset" => isset($input["offset"]) ? $input["offset"] : config_offset,
            "limit" => isset($input["limit"]) ? $input["limit"] : config_limit,
            "sort" => isset($input["sort"]) ? $input["sort"] : config_sort,
            "order" => isset($input["order"]) ? $input["order"] : config_order
        );
        $query = $this->db_table::orderBy($filter["sort"], $filter["order"]);
        $whereClause = $query;
        $whereClause->offset(($input["page_number"] - 1) * $filter["limit"]);       
        $whereClause->limit($filter["limit"]);

        if(isset($input["search_field"])){
            for($i=0 ; $i < count($input["search_field"]); $i++){
                $field = array_key_first($input["search_field"][$i]); //array('key1', 'key2', 'key3');
                if (in_array($field, $dataFields)) {
                    $whereClause->orWhere($field, "Like","%".$input["search_field"][$i][$field]."%");
                }
            }
        }
        
        $table = collect($whereClause->get());
        $data = array(
            "data_fields" => $this->dataFields(),
            "data" => $table,
            "limit" => $filter["limit"],
            "total" => $this->db_table->count()
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
        $dataFields = array(
            "code" => isset($input[0]["code"])?$input[0]["code"]:null,
            "name_en" => isset($input[1]["name_en"])?$input[1]["name_en"]:null,
            "name_kh" => isset($input[2]["name_kh"])?$input[2]["name_kh"]:null,
            "order_level" => isset($input[3]["order_level"])?$input[3]["order_level"]:0,
            "description" => isset($input[4]["description"])?$input[4]["description"]:null,
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