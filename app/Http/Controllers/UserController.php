<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
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
        $table = User::orderBy($filter["sort"], $filter["order"])
                                ->offset($filter["offset"])
                                ->limit($filter["limit"])
                                ->where("is_default", 0)
                                ->whereNotNull("name")
                                ->whereNotIn("role_id", [4])
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
        $input["modified_by"] = Auth::user()->id;
        $table = User::create($input);
        if($table){
            $status = 200;
            $boolen = true;
            $message = trans('title.message_success');
        }else{
            $status = 500;
            $boolen = false;
            $message = trans('title.message_error');
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
        $table = User::find($id);
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

    public function getProfile(){
        $id = Auth::user()->id;
        $table = User::find($id);
        $data = array(
            "data" => $table,
            "incentiveInfo" => User::getOfficerInfo($id)
        );
        return response()->json($data);
    }

    public function updateProfile(Request $request){
        $id = Auth::user()->id;
        $data = $request->all();
        // dd($data);
        $table = User::where('id', $id)->update([
            "name" => $data["name"],
            "gender" => $data["gender"],
            "dob" => $data["dob"],
            "email" => $data["email"],
            "avatar" => $data["avatar"]
        ]);
        $data = array(
            "data" => $data
        );
        return response()->json($data);
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
        if(isset($input["password"]) && $input["password"] != ''){
            $input["password"] = bcrypt($input["password"]);
        }
        $table = User::where('id', $id)->update($input);
        if($table){
            $status = 200;
            $boolen = true;
            $message = trans('title.message_update');
        }else{
            $status = 500;
            $boolen = false;
            $message = trans('title.message_error');
        }
        $data = array(
            "success" => $boolen,
            "message" => $message,
            "data" => User::findOrFail($id)
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
        $table = User::where('id', $id)->delete();
        if($table){
            $status = 200;
            $boolen = true;
            $message = trans('title.message_delete');
        }else{
            $status = 500;
            $boolen = false;
            $message = trans('title.message_error');
        }
        $data = array(
            "success" => $boolen,
            "message" => $message
        );
        return response()->json($data, $status);
    }
}
