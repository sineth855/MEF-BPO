<?php

namespace App\Http\Controllers\Modules\BudgetArrangement;

use App\Http\Controllers\Controller;
use App\Models\Modules\BudgetArrangement\PIPInvestment;
use App\Models\Modules\ProgramManagement\SubProgram;
use App\Models\Settings\ProjectType;
use App\Models\Settings\ProjectStatus;
use App\Models\Settings\Entity;
use Illuminate\Http\Request;
use Auth;
use DB;

class PIPInvestmentController extends Controller
{
    protected $db_table;
    public $path = "admin/modules/ceiling_rule";

    public function __construct()
    {
        $this->middleware('auth');
        $this->view_title = $this->path.'.entry_title';
        $this->db_table = new PIPInvestment;
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
            // "offset" => isset($input["offset"]) ? $input["offset"] : OFFSET,
            "limit" => isset($input["limit"]) ? $input["limit"] : LIMIT,
            "sort" => isset($input["sort"]) ? $input["sort"] : SORT,
            "order" => isset($input["order"]) ? $input["order"] : ORDER
        );
        $query = $this->db_table::orderBy($filter["sort"], $filter["order"]);
        $whereClause = $query;
        $whereClause->offset(($input["page_number"] - 1) * LIMIT);       
        $whereClause->limit($filter["limit"]);
        if(isset($input["search_field"])){
            for($i=0 ; $i < count($input["search_field"]); $i++){
                $field = array_key_first($input["search_field"][$i]); //array('key1', 'key2', 'key3');
                if (in_array($field, $dataFields)) {
                    $whereClause->orWhere($field, "Like","%".$input["search_field"][$i][$field]."%");
                }
            }
        }
        // $table = collect($whereClause->get());
        $table = PIPInvestment::getPIPInvestment();
        // dd($table);
        // $data = array(
        //     "data_fields" => $this->dataFields(),
        //     "data" => $table,
        //     "limit" => LIMIT,
        //     "total" => $this->db_table->count()
        // );
        // $status = array(
        //     [
        //         "label" => "មិនទាន់ដំណើរការ",
        //         "value" => "មិនទាន់ដំណើរការ",
        //     ],
        //     [
        //         "label" => "បានបញ្ចប់",
        //         "value" => "បានបញ្ចប់",
        //     ],
        //     [
        //         "label" => "បានអនុម័ត",
        //         "value" => "បានអនុម័ត",
        //     ]
        // );
        $data = array(
            "data_fields" => $this->dataFields(),
            "data" => $table,
            "project_type_id" => ProjectType::getProjectTypes(),
            "project_status_id" => ProjectStatus::getProjectStatus(),
            "sub_program_id" => SubProgram::getSubPrograms(),
            "entity_id" => Entity::getEntities(),
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
            "name_en" => isset($input[0]["name_en"])?$input[0]["name_en"]:null,
            "name_kh" => isset($input[1]["name_kh"])?$input[1]["name_kh"]:null,
            "issue_date" => isset($input[2]["issue_date"])?$input[2]["issue_date"]:null,
            "status" => isset($input[3]["status"])?$input[3]["status"]:1,
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