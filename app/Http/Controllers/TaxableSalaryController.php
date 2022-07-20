<?php

namespace App\Http\Controllers;

use App\Models\TaxableSalary;
use Illuminate\Http\Request;
use Auth;

class TaxableSalaryController extends Controller
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
        $table = TaxableSalary::orderBy($filter["sort"], $filter["order"])
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
        $input["created_by"] = Auth::user()->id;
        $input["modified_by"] = Auth::user()->id;
        $table = TaxableSalary::create($input);
        if($table){
            $status = 200;
            $boolen = true;
            $message = trans('taxable_salary.message_success');
        }else{
            $status = 500;
            $boolen = false;
            $message = trans('taxable_salary.message_error');
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
        $table = TaxableSalary::find($id);
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
        $input["modified_by"] = Auth::user()->id;
        $table = TaxableSalary::where('id', $id)->update($input);
        if($table){
            $status = 200;
            $boolen = true;
            $message = trans('taxable_salary.message_update');
        }else{
            $status = 500;
            $boolen = false;
            $message = trans('taxable_salary.message_error');
        }
        $data = array(
            "success" => $boolen,
            "message" => $message,
            "data" => TaxableSalary::findOrFail($id)
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
        $table = TaxableSalary::where('id', $id)->delete();
        if($table){
            $status = 200;
            $boolen = true;
            $message = trans('taxable_salary.message_delete');
        }else{
            $status = 500;
            $boolen = false;
            $message = trans('taxable_salary.message_error');
        }
        $data = array(
            "success" => $boolen,
            "message" => $message
        );
        return response()->json($data, $status);
    }
}
