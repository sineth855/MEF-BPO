<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entity;
use Auth;

class EntityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $input = $request->all();
        $filter = array(
            "offset" => isset($input["offset"]) ? $input["offset"] : OFFSET,
            "limit" => isset($input["limit"]) ? $input["limit"] : LIMIT,
            "sort" => isset($input["sort"]) ? $input["sort"] : SORT,
            "order" => isset($input["order"]) ? $input["order"] : ORDER
        );
        $tables = Entity::orderBy($filter["sort"], $filter["order"])
                                ->offset($filter["offset"])
                                ->limit($filter["limit"])
                                ->get();
        
        $dataObjects = array();
        foreach($tables as $table){
            $dataObjects[] = array(
                "id" => $table->id,
                "name" => $table->name,
                "limit_member" => $table->limit_member,
                "sector_id" => $table->sector_id,
                "is_active" => $table->is_active,
                "department_id" => $table->department_id,
                "sector" => $table->sector,
                "department" => $table->department,
                "code" => $table->code,
                "color" => $table->color,
                "order_level" => $table->order_level,
                "abbreviation" => $table->abbreviation,
                "deputy_commissionerofficer" => explode(',', $table->deputy_commissionerofficer),
                "professional_offier" => explode(',', $table->professional_offier)
            );
        }

        $data = array(
            "data" => $dataObjects,
            "total" => count($dataObjects)
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
        $deputy_commissionerofficer = '';
        $professional_officer = '';
        // for($i = 0; $i < sizeof($input['deputy_commissionerofficer']); $i++){
        //     $deputy_commissionerofficer .= $input['deputy_commissionerofficer'][$i]["label"].',';
        // }
        // for($i = 0; $i < sizeof($input['deputy_commissionerofficer']); $i++){
        //     $professional_officer .= $input['deputy_commissionerofficer'][$i]["label"].',';
        // }
        // $input["deputy_commissionerofficer"] = rtrim($deputy_commissionerofficer, ',');
        // $input["professional_offier"] =  rtrim($professional_officer, ',');
        $input["deputy_commissionerofficer"] = "";
        $input["professional_offier"] =  "";
        $departmentId = $input["department"]["id"];
        $departmentName = $input["department"]["label"];
        $input["department"] = $departmentName;
        $input["department_id"] = $departmentId;

        $sectorId = $input["sector"]["id"];
        $sectorName = $input["sector"]["label"];
        $input["sector"] = $sectorName;
        $input["sector_id"] = $sectorId;

        $input["modified_by"] = Auth::user()->id;
        $table = Entity::create($input);
        if($table){
            $status = 200;
            $boolen = true;
            $message = trans('entity.message_success');
        }else{
            $status = 500;
            $boolen = false;
            $message = trans('entity.message_error');
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
        $table = Entity::find($id);
        
        $data = array(
            "data" => $dataObject
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
        $input["modified_by"] = Auth::user()->id;
        $deputy_commissionerofficer = '';
        $professional_officer = '';
        // for($i = 0; $i < sizeof($input['deputy_commissionerofficer']); $i++){
        //     if($input['deputy_commissionerofficer'][$i]["label"]){
        //         $deputy_commissionerofficer .= $input['deputy_commissionerofficer'][$i]["label"].',';
        //     }else{
        //         $deputy_commissionerofficer .= $input['deputy_commissionerofficer'][$i].',';
        //     }
                
        // }
        // for($i = 0; $i < sizeof($input['professional_officer']); $i++){
        //     if($input['professional_officer'][$i]["label"]){
        //         $professional_officer .= $input['professional_officer'][$i]["label"].',';
        //     }else{
        //         $professional_officer .= $input['professional_officer'][$i].',';
        //     }
        // }
        // $input["deputy_commissionerofficer"] = rtrim($deputy_commissionerofficer, ',');
        // $input["professional_offier"] =  rtrim($professional_officer, ',');

        if(isset($input["department"]["id"])){
            $departmentId = $input["department"]["id"];
            $departmentName = $input["department"]["label"];
            $input["department"] = $departmentName;
            $input["department_id"] = $departmentId;
        }else{
            $input["department"] = $input["department"];
        }

        if(isset($input["sector"]["id"])){
            $sectorId = $input["sector"]["id"];
            $sectorName = $input["sector"]["label"];
            $input["sector"] = $sectorName;
            $input["sector_id"] = $sectorId;
        }else{
            $input["sector"] = $input["sector"];
        }

        $table = Entity::where('id', $id)->update($input);
        if($table){
            $status = 200;
            $boolen = true;
            $message = trans('entity.message_update');
        }else{
            $status = 500;
            $boolen = false;
            $message = trans('entity.message_error');
        }
        $data = array(
            "success" => $boolen,
            "message" => $message,
            "data" => Entity::findOrFail($id)
        );
        return response()->json($data, $status);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $table = Entity::where('id', $id)->delete();
        if($table){
            $status = 200;
            $boolen = true;
            $message = trans('entity.message_delete');
        }else{
            $status = 500;
            $boolen = false;
            $message = trans('entity.message_error');
        }
        $data = array(
            "success" => $boolen,
            "message" => $message
        );
        return response()->json($data, $status);
    }
}
