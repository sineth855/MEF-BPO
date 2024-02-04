<?php

namespace App\Http\Controllers\Modules\ProgramManagement;

use App\Http\Controllers\Controller;
use App\Models\Modules\ProgramManagement\Objective;
use App\Models\Modules\ProgramManagement\Program;
use App\Models\Settings\Entity;
use Illuminate\Http\Request;
use Auth;
use DB;
use CommonService;

class ObjectiveController extends Controller
{
    protected $db_table;
    public $path = "admin/modules/objective";

    public function __construct()
    {
        $this->middleware('auth');
        $this->view_title = $this->path.'.entry_title';
        $this->db_table = new Objective;
        $this->lang_path = $this->path;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     **/
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
        $objectives = Objective::getObjectives();
        $programs = Program::getPrograms("");
        $entities = Entity::getEntities();
        $data = array(
            "data_fields" => $this->dataFields(),
            "data" => $this->db_table::getAllClusterPrograms($filter),
            "dataHeader" => $this->dataHeader($flag = 1),
            "objective_id" => $objectives,
            "program_id" => $programs,
            "sub_program_id" => [],
            "cluster_activity_id" => [],
            "entity_id" => $entities,
            "entity_member_id" => [],
            "limit" => $filter["limit"],
            "total" => Objective::getCount($filter)
        );
        return response()->json($data);
    }

    public function dataHeader($flag)
    {
        $dataHeaders = array(
          "header1" => array(
            "label" => "ឆ្នាំមុន-២០២១(អនុវត្តរួច)",
            "rowspan" => 2,
            "colspan" => 0,
          ),
          "header2" => array(
            "label" => "ឆ្នាំបច្ចុប្បន្ន-២០២២(កំពុងអនុវត្ត)",
            "rowspan" => 2,
            "colspan" => 0,
          ),
          "header3" => array(
            "label" => "ឆ្នាំគ្រោងថវិកា-២០២៣",
            "rowspan" => 0,
            "colspan" => 2,
          ),
          "header4" => array(
            "label" => "ឆ្នាំគ្រោងថវិកា​២០២៤",
            "rowspan" => 2,
            "colspan" => 0,
          ),
          "header5" => array(
            "label" => "ឆ្នាំគ្រោងថវិកា២០២៥",
            "rowspan" => 2,
            "colspan" => 0,
          ),
        );

        $dataSubHeaders = array(
            "header1" => array(
                "label" => "គោលដៅ",
                "rowspan" => 0,
                "colspan" => 0
            ),
            "header2" => array(
                "label" => "មូលហេតុផ្លាស់ប្ដូរ (ធៀបឆ្នាំ២០២២)",
                "rowspan" => 0,
                "colspan" => 0
            )
        );

        $data = array(
            "dataHeaders" => $dataHeaders,
            "dataSubHeaders" => $dataSubHeaders,
            "hasColspan" => true,
            "colspan" => 9,
            "rowspan" => 0
        );
        
        return $data;
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
        $arr = $input;
        $push_array = array_merge(array(["created_by" => Auth::user()->id]));
        $arraySingle = array_merge($arr, $push_array);
        $result = call_user_func_array('array_merge', $arraySingle);
        $dataFields = $result;
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