<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use Illuminate\Http\Request;
use Auth;

class ConfigurationController extends Controller
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
            "offset" => isset($input["offset"]) ? $input["offset"] : config_offset,
            "limit" => isset($input["limit"]) ? $input["limit"] : config_limit,
            "sort" => isset($input["sort"]) ? $input["sort"] : config_sort,
            "order" => isset($input["order"]) ? $input["order"] : config_order
        );
        $table = Configuration::orderBy($filter["sort"], $filter["order"])
                                ->offset($filter["offset"])
                                ->limit($filter["limit"])
                                ->get();
        
        $data = array(
            "data" => $table,
            "total" => count($table)
        );
        return response()->json($data);
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
