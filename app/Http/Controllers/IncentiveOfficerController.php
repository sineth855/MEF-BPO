<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IncentiveOfficer;
use App\Models\TaxableSalary;
use App\User;
use Auth;
use DateTime;
use CommonService;

class IncentiveOfficerController extends Controller
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
        $table = IncentiveOfficer::orderBy($filter["sort"], $filter["order"])
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
        $input["modified_by"] = Auth::user()->id;
        $table = IncentiveOfficer::create($input);
        if($table){
            $status = 200;
            $boolen = true;
            $message = trans('incentive_officer.message_success');
        }else{
            $status = 500;
            $boolen = false;
            $message = trans('incentive_officer.message_error');
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
        $table = IncentiveOfficer::find($id);
        $data = array(
            "data" => $table,
            "incentiveHistories" => IncentiveOfficer::getIncetiveByOfficer($id),
            "compositionHistories" => IncentiveOfficer::getCompositionHistory($id),
            "userInfo" => IncentiveOfficer::getUserInfo($id)
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
        $table = IncentiveOfficer::where('id', $id)->update($input);
        if($table){
            $status = 200;
            $boolen = true;
            $message = trans('incentive_officer.message_update');
        }else{
            $status = 500;
            $boolen = false;
            $message = trans('incentive_officer.message_error');
        }
        $data = array(
            "success" => $boolen,
            "message" => $message
        );
        return response()->json($data, $status);
    }

    public function updateIncentiveOfficer(Request $request){
        $input = $request->all();
        $id = $input["id"];
        if($input['user_id'] == null){
            // Role Id 4 is default role for mobile user
            $createUserId = User::insertGetId(
                [
                    "role_id" => 4,
                    "username" => $input["username"],
                    "password" => bcrypt($input["password"])
                ]
            );
            $table = IncentiveOfficer::where('id', $id)->update([
                "user_id" => $createUserId
            ]);
        }else{
            if($input["password"] != null){
                $table = User::where('id', $input['user_id'])->update([
                    "password" => bcrypt($input["password"])
                ]);
            }
        }
        $message = trans('incentive_officer.message_update');
        $data = array(
            "success" => true,
            "message" => $message
        );
        return response()->json($data); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $table = IncentiveOfficer::where('id', $id)->delete();
        if($table){
            $status = 200;
            $boolen = true;
            $message = trans('incentive_officer.message_delete');
        }else{
            $status = 500;
            $boolen = false;
            $message = trans('incentive_officer.message_error');
        }
        $data = array(
            "success" => $boolen,
            "message" => $message
        );
        return response()->json($data, $status);
    }

    public function getOfficerGroupByEntities(Request $request){
        $input = $request->all();
        $entity_id = $input["entity_id"];
        $issueFromDate = date("Y-m-d", strtotime($input["issue_from_date"]));
        $issueToDate = date("Y-m-d", strtotime($input["issue_to_date"]));
        $allowCalTax = $input["allow_cal_tax"];
        // dd($input["issue_from_date"]);
        $numMonth = CommonService::GetNumberOfMonth($issueFromDate, $issueToDate);
        $activeOfficerInPeriod = 1; //IncentiveOfficer::activeOfficerInPeriod();
        if($activeOfficerInPeriod){
            $getIncentiveOfficerByEntities = IncentiveOfficer::getOfficerGroupByEntities($entity_id);
            $dataObj = array();
            $total_offier = 0;
            foreach($getIncentiveOfficerByEntities as $row){
                $incentiveOfficers = $row["officers"];
                $total_offier += count($incentiveOfficers);
                $officers = array();
                $i = 1;
                foreach($incentiveOfficers as $incentiveOfficer){
                    $officers[] = array(
                        "no" => $this->convertToKhmerNumber($i),
                        "id" => $incentiveOfficer["id"],
                        "user_id" => $incentiveOfficer["user_id"],
                        "first_name" => $incentiveOfficer["first_name"],
                        "last_name" => $incentiveOfficer["last_name"],
                        "duty" => $incentiveOfficer["duty"],
                        "bank_id" => $incentiveOfficer["bank_id"],
                        "bank_name" => $incentiveOfficer["bank_name"],
                        "bank_code" => $incentiveOfficer["bank_code"],
                        "entity" => $incentiveOfficer["entity"],
                        "entity_id" => $incentiveOfficer["entity_id"],
                        "position" => $incentiveOfficer["position"],
                        "duty" => $incentiveOfficer["duty"],
                        "bank_account_no" => $incentiveOfficer["bank_account_no"],
                        "updated_bank_acc" => $incentiveOfficer["updated_bank_acc"],
                        "tax" => $this->convertToKhmerNumber(number_format($this->calTaxableSalary(round($incentiveOfficer["incentive"]) * $numMonth, $allowCalTax))),
                        "return_amount" => $this->convertToKhmerNumber(number_format(0, 0)),
                        "incentive" => $incentiveOfficer["incentive"],
                        "incentive_kh" => $this->convertToKhmerNumber(number_format($incentiveOfficer["incentive"]), 0),
                        "incentive_after_tax" => $this->convertToKhmerNumber(number_format(floatval($incentiveOfficer["incentive"]) - floatval($this->calTaxableSalary(round($incentiveOfficer["incentive"]) * $numMonth, $allowCalTax)), 0)),
                        "reminder_amount" => $this->convertToKhmerNumber(number_format(round($incentiveOfficer["incentive"] * ($numMonth - 1)), 0)),
                        "total_incentive" => $this->convertToKhmerNumber(number_format(floatval(round($incentiveOfficer["incentive"]) * $numMonth), 0)),
                        "total_incentive_after_tax" => $this->convertToKhmerNumber(number_format((floatval(round($incentiveOfficer["incentive"]) * $numMonth) - floatval($this->calTaxableSalary(round($incentiveOfficer["incentive"]) * $numMonth, $allowCalTax))), 0))
                    );
                    $i++;
                }
                $dataObj[] = array(
                    "entity" => $row["entity"],
                    "officers" => $officers
                );

            }

            $data = array(
                "data" => $dataObj,
                "total" => $total_offier
            );
            $status = 200;
            return response()->json($data, $status);
        }
    }

    public function calTaxableSalary($incentive, $allowCalTax){
        $taxableSalaries = TaxableSalary::get();
        $taxToPay = 0;        
        if($allowCalTax == 'true'){
            if($incentive > 0){
                switch ($incentive) {
                    case ($incentive >= 0 && $incentive <= 1300000):
                        $taxToPay = ((floatval($incentive) / 100) * 0);
                    break;
                    case ($incentive >= 1300001 && $incentive <= 2000000):
                        $taxToPay = (((floatval($incentive) / 100) * 5) - 60000);
                    break;
                    case ($incentive >= 2000001 && $incentive <= 8500000):
                        ($taxToPay = ((floatval($incentive) / 100) * 10) - 160000);
                    break;
                    case ($incentive >= 8500001 && $incentive <= 12500000):
                        $taxToPay = (((floatval($incentive) / 100) * 15) - 585000);
                    break;
                    case ($incentive > 12500000):
                        $taxToPay = (((floatval($incentive) / 100) * 20) - 1210000);
                    break;
                    // default:
                    //     # code...
                    //     break;
                }
            }
        }
        return $taxToPay;
    }

    public function convertToKhmerNumber($number){
        $khmerNumber = [
           '1' => '១',
           '2' => '២',
           '3' => '៣',
           '4' => '៤',
           '5' => '៥',
           '6' => '៦',
           '7' => '៧',
           '8' => '៨',
           '9' => '៩',
           '0' => '០',
           '' => '០',
           'null' => '០'
         ];
         $arrNumbers = str_split($number);
         $newKhmerNumber = '';
         foreach ($arrNumbers as $number){
            if(isset($khmerNumber[$number])){
                $newKhmerNumber .= $khmerNumber[$number];
            }else{
                $newKhmerNumber .= ',';
            }
         }
         return $newKhmerNumber;
    }

    public function getOfficerByEntities(Request $request){
        $input = $request->all();
        $entity_id = $input["entity_id"];
        $getIncentiveOfficerByEntities = IncentiveOfficer::getOfficerByEntities($entity_id);
        $data = array(
            "data" => $getIncentiveOfficerByEntities,
            "total" => count($getIncentiveOfficerByEntities)
        );
        $status = 200;
        return response()->json($data, $status);
    }

    public function getOfficerListByEntities(Request $request){
        $input = $request->all();
        $entity_id = $input["entity_id"];
        $getIncentiveOfficerByEntities = IncentiveOfficer::getOfficerListByEntities($entity_id);
        $data = array(
            "data" => $getIncentiveOfficerByEntities,
            "total" => count($getIncentiveOfficerByEntities)
        );
        $status = 200;
        return response()->json($data, $status);
    }
}
