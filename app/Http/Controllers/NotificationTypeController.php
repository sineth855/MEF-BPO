<?php

namespace App\Http\Controllers;

use App\Models\NotificationType;
use Illuminate\Http\Request;
use Auth; 

class NotificationTypeController extends Controller
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
        $table = NotificationType::orderBy($filter["sort"], $filter["order"])
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
        $table = NotificationType::create($input);
        if($table){
            $status = 200;
            $boolen = true;
            $message = trans('notification_type.message_success');
        }else{
            $status = 500;
            $boolen = false;
            $message = trans('notification_type.message_error');
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
        $table = NotificationType::find($id);
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
        $table = NotificationType::where('id', $id)->update($input);
        if($table){
            $status = 200;
            $boolen = true;
            $message = trans('notification_type.message_update');
        }else{
            $status = 500;
            $boolen = false;
            $message = trans('notification_type.message_error');
        }
        $data = array(
            "success" => $boolen,
            "message" => $message
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
        $table = NotificationType::where('id', $id)->delete();
        if($table){
            $status = 200;
            $boolen = true;
            $message = trans('notification_type.message_delete');
        }else{
            $status = 500;
            $boolen = false;
            $message = trans('notification_type.message_error');
        }
        $data = array(
            "success" => $boolen,
            "message" => $message
        );
        return response()->json($data, $status);
    }
}
