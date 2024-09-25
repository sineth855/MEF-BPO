<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\Settings\Currency;
use App\Models\Settings\Planning;
use Illuminate\Http\Request;
use Auth;
use CommonService;

class ConfigurationController extends Controller
{
    protected $db_table;
    public $path = "admin/setting";

    public function __construct()
    {
        $this->middleware('auth');
        $this->view_title = $this->path.'.entry_position_title';
        $this->db_table = new Configuration;
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
        // $dataFields = $this->dataFields();
        $filter = CommonService::getFilter($input);
        $data = array(
            "data" => $this->db_table::getConfigs($filter),
            // "config_country" => array(["label" => "En", "value" => "1"],["label" => "Kh", "value" => "2"]),
            "config_language" => array(["label" => "En", "value" => "1"],["label" => "Kh", "value" => "2"]),
            "config_currency" => CommonService::optVals(Currency::class, $filter, 1), //array(["label" => "En", "value" => "1"],["label" => "Kh", "value" => "2"]),
            "config_date_format" => array(["label" => "Y-m-d", "value" => "Y-m-d"],["label" => "m-d-Y", "value" => "m-d-Y"]),
            "config_planning_year" => CommonService::optVals(Planning::class, $filter, 1),
        );
        return response()->json($data);
    }

    public function update(Request $request, $id){
        $input = $request->all();
        $conToSingleArr = call_user_func_array('array_merge', $input);
        // dd($conToSingleArr);
        // dd($call_user_func_array('array_merge', $conToSingleArr));
        $code = "config";
        foreach ($conToSingleArr as $key => $value) {
            $table = $this->db_table::where('key', $key)->first();
            if (substr($key, 0, strlen($code)) == $code) {
                if (!is_array($value)) {
                    $table->update(
                        [
                            "code" => $code,
                            "key" => $key,
                            "value" => $value,  
                        ]
                    );
                } else {
                    $table->update(
                        [
                            "code" => $code,
                            "key" => $key,
                            "value" => $value,  
                        ]
                    );
                }
            }
        }
        // $dataFields = $this->dataForm($input);
        // $table = $table=$this->db_table::find($id);
        // $table->update($dataFields);
        // if($config){
        $status = 200;
        $boolen = true;
        $message = trans('common.msg_update_successfully');
        // }else{
        //     $status = 500;
        //     $boolen = false;
        //     $message = trans('common.error_msg');
        // }
        $data = array(
            "success" => $boolen,
            "message" => $message,
            // "data" => $this->db_table::findOrFail($id)
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $table = Configuration::find($id);
        $data = array(
            "data" => $table
        );
        return response()->json($data);
    }
}
