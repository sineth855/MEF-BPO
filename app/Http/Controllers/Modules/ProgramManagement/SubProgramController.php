<?php

namespace App\Http\Controllers\Modules\ProgramManagement;

use App\Http\Controllers\Controller;
use App\Models\Modules\ProgramManagement\SubProgram;
use Illuminate\Http\Request;
use Auth;
use DB;

class SubProgramController extends Controller
{
    protected $db_table;
    public $path = "admin/modules/sub_program";

    public function __construct()
    {
        $this->middleware('auth');
        $this->view_title = $this->path.'.entry_title';
        $this->db_table = new SubProgram;
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
        
        $table = collect($whereClause->get());

        // {
        //     id: 1,
        //     name_en: "កម្មវិធីទី១",
        //     name_kh: "កម្មវិធីទី១",
        //     children: [
        //         {
        //             id: 1,
        //             name_en: "#001 - អនុកម្មវិធីទី ១",
        //             name_kh: "#001 - អនុកម្មវិធីទី ២",
        //             program: "កម្មវិធីទី១",
        //             indicator:{
        //                 data: [
        //                     {
        //                         id: 1,
        //                         code: "#1.3.10-1",
        //                         kpi_name_en: "ឈ្មោះសូចនាករ",
        //                         kpi_name_kh: "ឈ្មោះសូចនាករ",
        //                         order_level: 1,
        //                         status: "Active"
        //                     }, {
        //                         id: 2,
        //                         code: "#1.3.10-2",
        //                         kpi_name_en: "ឈ្មោះសូចនាករ",
        //                         kpi_name_kh: "ឈ្មោះសូចនាករ",
        //                         order_level: 1,
        //                         status: "Active"
        //                     }, {
        //                         id: 3,
        //                         code: "#1.3.10-3",
        //                         kpi_name_en: "ឈ្មោះសូចនាករជាភាសាអង់គ្លេស",
        //                         kpi_name_kh: "ឈ្មោះសូចនាករជាភាសាអង់គ្លេស",
        //                         order_level: 1,
        //                         status: "InActive"
        //                     },
        //                 ],
        //             }
        //         }
        //     ]
        // }
        $hhhh = array(
               [
                "id" => 1,
                "code" => "#1.3.10-1",
                "kpi_name_en" => "ឈ្មោះសូចនាករ",
                "kpi_name_kh" => "ឈ្មោះសូចនាករ",
                "order_level" => 1,
                "status" => "Active"
            ],
            [
                "id" => 2,
                "code" => "#1.3.10-1",
                "kpi_name_en" => "ឈ្មោះសូចនាករ",
                "kpi_name_kh" => "ឈ្មោះសូចនាករ",
                "order_level" => 1,
                "status" => "Active"
            ]
        );
        $ll = array(
            "data" => $hhhh
        );
        $lln = array(
            "data" => null
        );
        $table_test = array(
            [
                "id" => 1,
                "name_en" => "#001-កម្មវិធីទី ១១",
                "name_kh" => "#001-កម្មវិធីទី ១១",
                "children" => array(
                    [
                        "id" => 1,
                        "name_en"=> "#001 - អនុកម្មវិធីទី ១១១",
                        "name_kh"=> "#001 - អនុកម្មវិធីទី ១១១",
                        "indicator"=> $ll
                    ]
                )
            ],[
                "id" => 2,
                "name_en" => "#002-កម្មវិធីទី ២២",
                "name_kh" => "#002-កម្មវិធីទី ២២",
                "children" => array(
                    [
                        "id" => 1,
                        "name_en"=> "#001 - អនុកម្មវិធីទី ២២២",
                        "name_kh"=> "#001 - អនុកម្មវិធីទី ២២២២",
                        "indicator"=> $lln
                    ]
                )
            ]
        );

        $objectives = array(
            [
                "label" => "គោលបំណងទី១",
                "value" => 1,
            ],
            [
                "label" => "គោលបំណងទី២",
                "value" => 2,
            ],
            [
                "label" => "គោលបំណងទី៣",
                "value" => 3,
            ]
        );
        $entities = array(
            [
                "label" => "អង្គភាពទី២២១",
                "value" => 1,
            ],
            [
                "label" => "អង្គភាពទី២២២",
                "value" => 2,
            ]
        );
        $entity_members = array(
            [
                "label" => "សមាជិកទី១",
                "value" => 1,
            ],
            [
                "label" => "សមាជិកទី២",
                "value" => 2,
            ]
        );
        $data = array(
            "data_fields" => $this->dataFields(),
            "data" => SubProgram::getSubProgramByProgram($filter),
            "objective_id" => $objectives,
            "entity_id" => $entities,
            "entity_member_id" => $entity_members,
            "limit" => LIMIT,
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
            "program_id" => isset($input[0]["program_id"])?$input[0]["program_id"]:null,
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