<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incentive;
use App\Models\IncentiveOfficer;
use App\Models\IncentiveToOfficer;
use App\Models\Income;
use App\Models\Expense;
use App\Http\Controllers\IncentiveController;
use Auth;
use DB;
use Schema;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function incentiveByEntity(Request $request)
    {
        $input = $request->all();
        $table = Incentive::get();
        $data = array(
            "data" => $table,
            "total" => count($table)
        );
        return response()->json($data);
    }

    public function summary(){
        // $query = DB::table("incentive_to_officer")->SELECT(DB::raw("QUARTER(`issue_to_date`) as quarter, issue_to_date ,(sum(incentive) + sum(reminder_amount)) as amount"))
        //         // ->groupBy(DB::raw("QUARTER(`issue_to_date`)"))
        //         ->groupBy(DB::raw("`issue_to_date`"))
        //         ->whereRaw('year(`issue_to_date`) = ?', array(date('Y')))
        //         ->get();
        // $i = 0;
        // $monthArr = array("01","02","03","04","05","06","07","08","09","10","11","12");
        // $array = array();
        // $monthSys = "";
        // $amountInc = "";
        // foreach($query as $row){
        //     $month = date("m", strtotime($row->issue_to_date));
        //     if(in_array($month, $monthArr)){
        //         $check = true;
        //     }else{
        //         $check = false;
        //     }
        //     $array[] = array("month" => $month, "".$month."" => $row->amount, "check" => $check);
        //     $monthSys .= $month.',';
        //     $amountInc .= $row->amount.',';
        //     $i++;
        // }
        // // dd($array);
        // $explode = explode(',', $monthSys);
        // $explodeAmountInc = explode(',', $amountInc);
        // array_pop($explode);
        // array_pop($explodeAmountInc);
        // // dd($explodeAmountInc);
        // $who = array();
        // foreach($explode as $key => $value){
        //     $who[] = array(
        //         $key=>$value
        //     );
        // }
        // // dd($who);
        // // print_r($who);
        // // $arrayPop = array_pop($explode);

        // $quarter1 = array(0, 1, 2);
        // $quarter2 = array(3, 4, 5);
        // $quarter3 = array(6, 7, 8);
        // $quarter4 = array(9,10,11);
        
        // $q1Result = array();
        // $q1 = 0;
        // foreach($quarter1 as $result){
        //     $monthToAdjust = 0;
        //     $boolen = false;
        //     if(in_array($result, $explode)){
        //         $boolen = true;
        //     }else{
        //         $monthToAdjust = $result;
        //     }
        //     $amount = 0;
        //     if(isset($array[$result]["0".$result])){
        //         $amount = $array[$result]["0".$result];
        //     }
        //     $q1Result[] = array(
        //         "month" => $result + 1,
        //         "amount" => $amount,
        //         "check" => $boolen,
        //         "monthToAdjust" => $monthToAdjust
        //     );
        // }

        // $q2Result = array();
        // $q2 = 0;
        // foreach($quarter2 as $result){
        //     $boolen = false;
        //     $monthToAdjust = 0;
        //     if(in_array($result, $explode)){
        //         $boolen = true;
        //     }else{
        //         $monthToAdjust = ($result);
        //     }
        //     $amount = 0;
        //     if(isset($array[$result]["0".$result])){
        //         $amount = $array[$result]["0".$result];
        //     }
        //     $q2Result[] = array(
        //         "month" => $result + 1,
        //         "amount" => $amount,
        //         "check" => $boolen,
        //         "monthToAdjust" => $monthToAdjust
        //     );
        // }

        // $q3Result = array();
        // $q3 = 0;
        // foreach($quarter3 as $result){
        //     $monthToAdjust = 0;
        //     $boolen = false;
        //     if(in_array($result, $explode)){
        //         $boolen = true;
        //     }else{
        //         $monthToAdjust = ($result + 2);
        //     }
        //     $amount = 0;
        //     if(isset($array[$result]["0".$result])){
        //         $amount = $array[$result]["0".$result];
        //     }
        //     $q3Result[] = array(
        //         "month" => $result + 1,
        //         "amount" => $amount,
        //         "check" => $boolen,
        //         "monthToAdjust" => $monthToAdjust
        //     );
        // }

        // $q4Result = array();
        // $q4 = 0;
        // foreach($quarter4 as $result){
        //     $boolen = false;
        //     if(in_array($result, $explode)){
        //         $boolen = true;
        //     }
        //     $amount = 0;
        //     if(isset($array[$result][$result])){
        //         $amount = $array[$result][$result];
        //     }
        //     $q4Result[] = array(
        //         "month" => $result + 1,
        //         "amount" => $amount,
        //         "check" => $boolen
        //     );
        // }

        // $resultArr = array(
        //     "Q1" => $q1Result,
        //     "Q2" => $q2Result,
        //     "Q3" => $q3Result,
        //     "Q4" => $q4Result
        // );
        // dd($resultArr);

        
        // $i = 0;
        // $hasMonth = array();
        // foreach($monthArr as $month){
        //     $checkVal = true;
        //     $amount = 0;
        //     if(in_array($month, $explode)){
        //         $checkVal = true;
        //         $num = $i;
        //         // $amount = $array[$i]["amount"];
        //     }else{
        //         $checkVal = false;
        //         $num = $i;
        //     }
        //     $hasMonth[] = array("Month"=> $month, "Check" => $checkVal);
        //     $i++;
        // }
        // print_r($array);
        // dd($hasMonth);
        // #################
        $mulNum = 1000000;
        $exchangeRate = 4000;
        $totalOfficer = count(IncentiveOfficer::Where("status", 1)->get());
        $totalIncentive = round(Incentive::sum("total_incentive") / $mulNum);
        $totalIncome = round(Income::sum("amount") / $mulNum);
        // dd(round(Income::sum("amount")));
        $totalIncomeDollar = (Income::sum("amount") / $exchangeRate) / $mulNum;
        $totalExpense = round(IncentiveToOfficer::sum("incentive") / $mulNum);
        $totalExpenseDollar = (IncentiveToOfficer::sum("incentive") / $exchangeRate) / $mulNum;
        // $totalExpense = round((IncentiveToOfficer::sum("incentive") + IncentiveToOfficer::sum("reminder_amount")) / $mulNum);
        // $totalExpenseDollar = ((IncentiveToOfficer::sum("incentive") + IncentiveToOfficer::sum("reminder_amount")) / $exchangeRate) / $mulNum;
        $totalTaxIncentive = round(Incentive::sum("total_tax") / $mulNum);
        $totalRemainDollar = round(floatval($totalIncomeDollar) - floatval($totalExpenseDollar));
        
        // $getOfficers = DB::table("incentive_to_officer as i2o")
        //                 ->select(DB::raw("year(i2o.issue_from_date) as issue_from_date"), DB::raw("count(DISTINCT officer_id) as number_officer"), )
        //                 ->join("incentive_officer as io", "io.id", "=", "i2o.officer_id")
        //                 ->where("io.status", 1)
        //                 ->groupBy(DB::raw("DATE_FORMAT(issue_from_date, '%Y')"))
        //                 ->get();

        $getOfficers = DB::table("incentive_to_officer as i2o")
                        ->select(DB::raw("count(DISTINCT officer_id) as number_officer"), DB::raw("DATE_FORMAT(issue_from_date, '%Y') as year"))
                        ->join("incentive_officer as io", "io.id", "=", "i2o.officer_id")
                        ->where("io.status", 1)
                        ->groupBy(DB::raw("DATE_FORMAT(issue_from_date, '%Y')"))
                        ->orderBy("year")
                        ->get();
        // dd($getOfficers);

        $getThisYearIncomes = Income::whereRaw('year(`issue_date`) = ?', array(date('Y')))
                        // ->where('issue_date', "<=", NOW())
                        ->Select(DB::raw("DATE_FORMAT(issue_date, '%m-%Y') as month, sum(amount) as total_amount"))
                        // ->select(\DB:raw("DATE_FORMAT(issue_date, '%m') as month, sum(amount) as total_income"))
                        ->groupBy(DB::raw("DATE_FORMAT(issue_date, '%m-%Y')"))
                        ->get();
        
        // dd($getThisYearIncomes);                
        $getLastYearIncomes = Income::whereRaw('year(`issue_date`) = YEAR(DATE_SUB(CURDATE(), INTERVAL 1 YEAR))')
            // ->where('issue_date', "<=", NOW())
            ->Select(DB::raw("DATE_FORMAT(issue_date, '%m-%Y') as month, sum(amount) as total_amount"))
            // ->select(\DB:raw("DATE_FORMAT(issue_date, '%m') as month, sum(amount) as total_income"))
            ->groupBy(DB::raw("DATE_FORMAT(issue_date, '%m-%Y')"))
            ->get();
        // dd($getLastYearIncomes); 
        $quarterIncomeThisYear = DB::table("income")->SELECT(DB::raw("QUARTER(`issue_date`) as quarter, sum(amount) as amount"))
                                                    ->groupBy(DB::raw("QUARTER(`issue_date`)"))
                                                    ->whereRaw('year(`issue_date`) = ?', array(date('Y')))
                                                    ->get();
        // dd($quarterIncomeThisYear);
                                                    // $quarterIncomeThisYear = DB::table("income")->SELECT(DB::raw("QUARTER(`issue_date`) as quarter, sum(amount) as amount"))
        //                                             ->groupBy(DB::raw("QUARTER(`issue_date`)"))
        //                                             ->whereRaw('year(`issue_date`) = ?', array(date('Y')))
        //                                             ->get();
        

        $quarterIncomeLastYear = DB::table("income")->SELECT(DB::raw("QUARTER(`issue_date`) as quarter, sum(amount) as amount"))
                                                    ->groupBy(DB::raw("QUARTER(`issue_date`)"))
                                                    ->whereRaw('year(`issue_date`) = YEAR(DATE_SUB(CURDATE(), INTERVAL 1 YEAR))')
                                                    ->get();
        // dd($quarterIncomeLastYear);
        // $quarterExpenseThisYear = DB::table("incentive_to_officer")->SELECT(DB::raw("QUARTER(`issue_from_date`) as quarter, sum(incentive) as amount"))
        //                                                       ->groupBy(DB::raw("QUARTER(`issue_from_date`)"))
        //                                                       ->whereRaw('year(`issue_from_date`) = ?', array(date('Y')))
        //                                                       ->get();
        $quarterExpenseThisYear = DB::table("incentive_to_officer")->SELECT(DB::raw("QUARTER(`issue_to_date`) as quarter, (sum(incentive) + sum(reminder_amount)) as amount"))
                                                              ->groupBy(DB::raw("QUARTER(`issue_to_date`)"))
                                                              ->whereRaw('year(`issue_to_date`) = ?', array(date('Y')))
                                                              ->get();

        // dd($quarterExpenseThisYear);
        
        $quarterExpenseLastYear = DB::table("incentive_to_officer")->SELECT(DB::raw("QUARTER(`issue_to_date`) as quarter, sum(incentive) as amount"))
                                                              ->groupBy(DB::raw("QUARTER(`issue_to_date`)"))
                                                              ->whereRaw('year(`issue_to_date`) = YEAR(DATE_SUB(CURDATE(), INTERVAL 1 YEAR))')
                                                              ->get();
        // dd($quarterExpenseLastYear);
        $dataIncomThisYear = ""; 
        $l=0;
        $countIncomeThisYear = count($quarterIncomeThisYear);
        foreach($quarterIncomeThisYear as $quarterIncomeThisYearInfo){
            if(($countIncomeThisYear - 1)  == $l){
                $dataIncomThisYear .= $this->convertToKhAmount($mulNum, $quarterIncomeThisYearInfo->amount);
            }else{
                $dataIncomThisYear .= $this->convertToKhAmount($mulNum, $quarterIncomeThisYearInfo->amount).',';
            }
            $l++;
        }
        
        $dataIncomLastYear = ""; 
        $m=0;
        $countIncomeLastYear = count($quarterIncomeLastYear);
        foreach($quarterIncomeLastYear as $quarterIncomeLastYearInfo){
            if(($countIncomeLastYear - 1)  == $m){
                $dataIncomLastYear .= $this->convertToKhAmount($mulNum, $quarterIncomeLastYearInfo->amount);
            }else{
                $dataIncomLastYear .= $this->convertToKhAmount($mulNum, $quarterIncomeLastYearInfo->amount).',';
            }
            $m++;
        }
        
        $dataExpenseThisYear = ""; 
        $n=0;
        $countExpenseThisYear = count($quarterExpenseThisYear);
        foreach($quarterExpenseThisYear as $quarterExpenseThisYearInfo){
            if(($countExpenseThisYear - 1)  == $n){
                $dataExpenseThisYear .= $this->convertToKhAmount($mulNum, $quarterExpenseThisYearInfo->amount);
            }else{
                $dataExpenseThisYear .= $this->convertToKhAmount($mulNum, $quarterExpenseThisYearInfo->amount).',';
            }
            $n++;
        }

        $lenthExpenseThisYear = '';
        $strExThisYear = "";
        if($countExpenseThisYear < 4){
            $totalQuarterExpenseThisYear = 4 - $countExpenseThisYear;
            $i = 0;
            for($i = 0; $i < $totalQuarterExpenseThisYear; $i++){
                if($i == ($totalQuarterExpenseThisYear - 1)){
                    $strExThisYear .= '';//'0';
                }else{
                    $strExThisYear .= ',0'.',';
                }
            }
        }

        $dataExpenseLastYear = ""; 
        $p=0;
        $countExpenseLastYear = count($quarterIncomeLastYear);
        foreach($quarterExpenseLastYear as $quarterExpenseLastYearInfo){
            if(($countExpenseLastYear - 1)  == $p){
                $dataExpenseLastYear .= $this->convertToKhAmount($mulNum, $quarterExpenseLastYearInfo->amount);
            }else{
                $dataExpenseLastYear .= $this->convertToKhAmount($mulNum, $quarterExpenseLastYearInfo->amount).',';
            }
            $p++;
        }

        $quaterThisYearIncome = explode(",", $dataIncomThisYear);
        $quaterLastYearIncome = explode(",", $dataIncomLastYear);
        $quaterThisYearExpense = explode(",", ($dataExpenseThisYear.$strExThisYear));
        $quaterLastYearExpense = explode(",", $dataExpenseLastYear);
        $g = 0;
        $remainAmountThisYear = '';
        $remainAmountLastYear = '';
        // print_r($quaterThisYearExpense);
        if(count($quaterThisYearIncome) > 1){
            if(count($quaterLastYearIncome) > 0){
                for($g = 0; $g < count($quaterLastYearIncome); $g++){
                    if((count($quaterLastYearIncome) - 1) == $g){
                        if(isset($quaterThisYearExpense[$g])){
                            $quaterThisYearExpenseVal = floatval($quaterThisYearExpense[$g]);
                        }else{
                            $quaterThisYearExpenseVal = 0;
                        }

                        if((floatval($quaterThisYearIncome[$g]) - $quaterThisYearExpenseVal) == 0){
                            $remainAmountThisYear .= $this->convertToKhAmount($mulNum, (floatval($totalIncome) - floatval($totalExpense)));
                        }else{
                            $remainAmountThisYear .= $this->convertToKhAmount($mulNum, (floatval($quaterThisYearIncome[$g]) - floatval($quaterThisYearExpense[$g])));
                        }
                        if(isset($quaterLastYearExpense[$g])){
                            $remainAmountLastYear .= $this->convertToKhAmount($mulNum, (floatval($quaterLastYearIncome[$g]) - floatval($quaterLastYearExpense[$g])));
                        }else{
                            $remainAmountLastYear .= $this->convertToKhAmount($mulNum, (floatval($quaterLastYearIncome[$g]) - floatval(0)));
                        }
                    }else{
                        if((floatval($quaterThisYearIncome[$g]) - floatval($quaterThisYearExpense[$g])) == 0){
                            $remainAmountThisYear .= $this->convertToKhAmount($mulNum, (floatval($totalIncome) - floatval($totalExpense))).',';
                        }else{
                            $remainAmountThisYear .= $this->convertToKhAmount($mulNum, (floatval($quaterThisYearIncome[$g]) - floatval($quaterThisYearExpense[$g]))).',';
                        }
                        // dd(floatval($quaterLastYearIncome[$g]));
                        if(isset($quaterLastYearExpense[$g])){
                            $remainAmountLastYear .= $this->convertToKhAmount($mulNum, (floatval($quaterLastYearIncome[$g]) - floatval($quaterLastYearExpense[$g]))).',';
                        }else{
                            $remainAmountLastYear .= $this->convertToKhAmount($mulNum, (floatval($quaterLastYearIncome[$g]) - floatval(0))).',';
                        }
                    }
                    // $g++;
                }
            }
        }
        // dd($remainAmountLastYear);
        // echo $remainAmountThisYear."<br/>";
        // echo $remainAmountLastYear;
        // dd("test");
        $dataInfo = array(
            // "totalOfficer" => $totalOfficer,
            // "totalIncentive" => $this->convertToKhmerNumber($totalIncentive),
            // "totalIncome" => $this->convertToKhmerNumber($totalIncome),
            // "totalExpense" => $this->convertToKhmerNumber($totalExpense),
            // "totalTaxIncentive" => $this->convertToKhmerNumber($totalTaxIncentive),
            // "totalRemain" => $this->convertToKhmerNumber(floatval($totalIncome) - floatval($totalExpense)),

            "quaterThisYearIncome" => $quaterThisYearIncome,
            "quaterLastYearIncome" => $quaterLastYearIncome,

            "quaterThisYearExpense" => $quaterThisYearExpense,
            "quaterLastYearExpense" => $quaterLastYearExpense,

            "remainAmountThisYear" => explode(",", $remainAmountThisYear),
            "remainAmountLastYear" => explode(",", $remainAmountLastYear),
            "officerByYears" => $getOfficers,
            "totalOfficer" => $totalOfficer,
            "totalIncentive" => number_format($totalIncentive, 2),
            "totalIncome" => number_format($totalIncome, 2),
            "totalIncomeDollar" => number_format($totalIncomeDollar, 2),
            "totalExpense" => number_format($totalExpense, 2),
            "totalExpenseDollar" => number_format($totalExpenseDollar, 2),
            "totalTaxIncentive" => number_format($totalTaxIncentive,2),
            "totalRemain" => number_format((floatval($totalIncome) - floatval($totalExpense)),2),
            "totalRemainDollar" => number_format(($totalIncomeDollar - $totalExpenseDollar), 2),
            "incomeThisYear" => $getThisYearIncomes,
            "incomeLastyear" => $getLastYearIncomes,
            "khmer_date" => KHMER_DATE,
            "currentDay" => $this->convertToKhmerDate(date("D")),
            "currentDate" => $this->convertToKhmerNumber(date("d")),
            "currentMonth" => $this->convertKhMonth(date("m")),
            "currentYear" => $this->convertToKhmerNumber(date("Y"))
        );
        $data = array(
            "data" => $dataInfo
        );
        return response()->json($data);

    }

    public function convertToKhAmount($mulNum, $amount){
        $newAmount = 0;
        if($mulNum > $amount){
            $newAmount = $amount;
        }else{
            $newAmount = $amount / $mulNum;
        }

        return intval($newAmount);
    }

    public function convertToKhmerDate($data){
        $str='';
        switch ($data) {
            case "Sun":
                # code...
                $str = 'អាទិត្យ';
                break;
            case "Mon":
                # code...
                $str = 'ច័ន្ទ';
                break;
            case "Tue":
                # code...
                $str = 'អង្គារ៍';
                break;
            case "Wed":
                # code...
                $str = 'ពុធ';
                break;
            case "Thu":
                # code...
                $str = 'ព្រហស្បត្តិ៍';
                break;
            case "Fri":
                # code...
                $str = 'សុក្រ';
                break;
            case "Sat":
                # code...
                $str = 'សៅរ៍';
                break;
        }
        return $str;
    }

    public function convertKhmerChankati(){
        $currentDate = date("Y-m-d");
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
        ];
        $arrNumbers = str_split($number);
        $newKhmerNumber = '';
        $i = 1;
        foreach ($arrNumbers as $number){
            $newKhmerNumber .= $khmerNumber[$number];
            // $newKHNumber = "";
            // if($i % 3 == 0){
            //     $newKHNumber .= $khmerNumber[$number].",";
            // }else{
            //     $newKHNumber .= $khmerNumber[$number];
            // }
            // $i++;
        }
        // return $newKHNumber;
        return $newKhmerNumber;
    }

    public function convertKhMonth($data){
        $str='';
        switch ($data) {
            case 1:
                # code...
                $str = 'មករា';
                break;
            case 2:
                # code...
                $str = 'កុម្ភះ';
                break;
            case 3:
                # code...
                $str = 'មិនា';
                break;
            case 4:
                # code...
                $str = 'មេសា';
                break;
            case 5:
                # code...
                $str = 'ឧសភា';
                break;
            case 6:
                # code...
                $str = 'មិថុនា';
                break;
            case 7:
                # code...
                $str = 'កក្កដា';
                break;
            case 8:
                # code...
                $str = 'សីហា';
                break;
            case 9:
                # code...
                $str = 'កញ្ញា';
                break;
            case 10:
                # code...
                $str = 'តុលា';
                break;
            case 11:
                # code...
                $str = 'វិច្ឆិកា';
                break;
            case 12:
                # code...
                $str = 'ធ្នូ';
                break;
            
            default:
                # code...
                $str = 'មករា';
                break;
        }
        return $str;
    }

    // public function incomeByEntity(){
    //     $query = DB::table("entity")->OrderBy("order_level")->Limit(15)->get();
    //     $color = "";
    //     $amount = "";
    //     $abbreviation = "";
    //     foreach($query as $row){
    //         $id = $row->id;
    //         $totalIncome = DB::table("income")->where("entity_id", $id)->sum("amount");
    //         $color .= $row->color.",";
    //         $abbreviation .= $row->abbreviation.",";
    //         $amount .= $totalIncome.",";
    //     }
        
    //     $dd = substr_replace($color, ",", -1);
    //     $data = array(
    //         "color" => explode(",", $color),
    //         "abbreviation" => explode(",", $abbreviation),
    //         "amount" => explode(",", $amount)
    //     );
    //     return response()->json($data);
    // }
    public function incomeBySector(){
        $mulNum = 1000000;
        $getTop10RankIncomes = DB::table('income')
                                ->join('entity', 'entity.id' ,'=', 'income.entity_id')
                                ->join('sector', 'sector.id' ,'=' ,'entity.sector_id')
                                ->whereRaw('year(`issue_date`) = ?', array(date('Y')))
                                ->select('sector.name as sector_name', 'entity.sector_id as sector_id', DB::raw('sum(amount) as amount'))
                                ->groupBy('sector.name', 'entity.sector_id')
                                ->OrderBy("entity.sector_id", "desc")
                                // ->Limit(10)
                                ->get();
                                
        $getTop10RankIncomesLastYear = DB::table('income')
                                ->join('entity', 'entity.id' ,'=', 'income.entity_id')
                                ->join('sector', 'sector.id' ,'=' ,'entity.sector_id')
                                ->whereRaw('year(`issue_date`) = YEAR(DATE_SUB(CURDATE(), INTERVAL 1 YEAR))')
                                ->select('sector.name as sector_name', 'entity.sector_id as sector_id', DB::raw('sum(amount) as amount'))
                                ->groupBy('sector.name', 'entity.sector_id')
                                ->OrderBy("entity.sector_id", "desc")
                                // ->Limit(10)
                                ->get();
        // $getTop10RankIncomesLastYear = DB::table('income')
        //                         ->join('entity', 'entity.id' ,'=', 'incentive_to_officer.entity_id')
        //                         ->join('sector', 'sector.id' ,'=' ,'entity.sector_id')
        //                         ->whereRaw('year(`issue_from_date`) = YEAR(DATE_SUB(CURDATE(), INTERVAL 1 YEAR))')
        //                         ->select('sector.name as sector_name', 'entity.sector_id as sector_id', DB::raw('sum(incentive) as amount'))
        //                         ->groupBy('sector.name', 'entity.sector_id')
        //                         ->OrderBy("entity.sector_id", "desc")
        //                         // ->Limit(10)
        //                         ->get();

        $lastYearIncome = "";
        $k = 0;
        foreach($getTop10RankIncomesLastYear as $getTop10RankIncomesLastYearInfo){
            if((count($getTop10RankIncomesLastYear) - 1) == $k){
                $lastYearIncome .= $getTop10RankIncomesLastYearInfo->amount;
            }else{
                $lastYearIncome .= $getTop10RankIncomesLastYearInfo->amount.",";
            }
            $k++;
        }
        
        $lastYearIncomeExplode = explode(",", $lastYearIncome);

        // dd($getTop10RankIncomesLastYear);
        $i = 0;
        $thisYearIncome = "";
        $titleEntityArr = "";
        $amountEntityArr = "";
        $data = array();
        foreach($getTop10RankIncomes as $getTop10RankIncome){
            if((count($getTop10RankIncomes) - 1) == $i){
                $titleEntityArr .= $getTop10RankIncome->sector_name;
                $amountEntityArr .= $this->convertToKhAmount($mulNum, $getTop10RankIncome->amount);
            }else{
                $titleEntityArr .= $getTop10RankIncome->sector_name.",";
                $amountEntityArr .= $this->convertToKhAmount($mulNum, $getTop10RankIncome->amount).",";
            }

            $calDevide100 = floatval($lastYearIncomeExplode[$i]) / 100;

            $data[] = array(
                "no" => ($i + 1),
                "sector_id" => $getTop10RankIncome->sector_id,
                "sector_name" => $getTop10RankIncome->sector_name,
                "amount" => $this->convertToKhAmount($mulNum, floatval($getTop10RankIncome->amount)),
                "amountLastYear" => floatval($lastYearIncomeExplode[$i]),
                "devide" => $calDevide100,
                "percentage" => floatval(number_format((intval($lastYearIncomeExplode[$i]) - intval($getTop10RankIncome->amount)) / intval($calDevide100), 2)),
                "comparedResult" => ((intval($lastYearIncomeExplode[$i]) - intval($getTop10RankIncome->amount)) / intval($calDevide100))
            );
            $i++;
        }


        
        // this year
        // 1831540890, 49526010, 46130800, 68567641, 458613153
        // last year
        // 2071500000,769200000,141600000,626700000,1378800000
        
        // print_r($amountEntityArr);
        // dd($lastYearIncome);
        return response()->json(
            [
                "data" => $data,
                "sector" => explode(",", $titleEntityArr),
                "amountEntity" => explode(",", $amountEntityArr)
            ]
        );
    }

    public function expenseBySector(){
        $mulNum = 1000000;
        // $getTop10RankIncomes = DB::table('income')
        //                         ->join('entity', 'entity.id' ,'=', 'income.entity_id')
        //                         ->join('sector', 'sector.id' ,'=' ,'entity.sector_id')
        //                         ->whereRaw('year(`issue_date`) = ?', array(date('Y')))
        //                         ->select('sector.name as sector_name', 'entity.sector_id as sector_id', DB::raw('sum(amount) as amount'))
        //                         ->groupBy('sector.name', 'entity.sector_id')
        //                         ->OrderBy("entity.sector_id", "desc")
        //                         // ->Limit(10)
        //                        ->get();
        
        $getTop10RankExpensesThisYear = DB::table('incentive_to_officer')
                                ->join('entity', 'entity.id' ,'=', 'incentive_to_officer.entity_id')
                                ->join('sector', 'sector.id' ,'=' ,'entity.sector_id')
                                ->whereRaw('year(`issue_from_date`) = ?', array(date('Y')))
                                ->select('sector.name as sector_name', 'entity.sector_id as sector_id', DB::raw('sum(incentive) as amount'))
                                ->groupBy('sector.name', 'entity.sector_id')
                                ->OrderBy("entity.sector_id", "desc")
                                // ->Limit(10)
                                ->get();      

        $getTop10RankExpensesLastYear = DB::table('incentive_to_officer')
                                ->join('entity', 'entity.id' ,'=', 'incentive_to_officer.entity_id')
                                ->join('sector', 'sector.id' ,'=' ,'entity.sector_id')
                                ->whereRaw('year(`issue_from_date`) = YEAR(DATE_SUB(CURDATE(), INTERVAL 1 YEAR))')
                                ->select('sector.name as sector_name', 'entity.sector_id as sector_id', DB::raw('sum(incentive) as amount'))
                                ->groupBy('sector.name', 'entity.sector_id')
                                ->OrderBy("entity.sector_id", "desc")
                                // ->Limit(10)
                                ->get();

        $lastYearIncome = "";
        $k = 0;
        foreach($getTop10RankExpensesLastYear as $getTop10RankExpensesLastYearInfo){
            if((count($getTop10RankExpensesLastYear) - 1) == $k){
                $lastYearIncome .= $getTop10RankExpensesLastYearInfo->amount;
            }else{
                $lastYearIncome .= $getTop10RankExpensesLastYearInfo->amount.",";
            }
            $k++;
        }
        
        $lastYearExpenseExplode = explode(",", $lastYearIncome);

        // dd($getTop10RankExpensesThisYear);
        $i = 0;
        $thisYearIncome = "";
        $titleEntityArr = "";
        $amountEntityArr = "";
        $data = array();
        foreach($getTop10RankExpensesThisYear as $getTop10RankExpensesThisYearInfo){
            if((count($getTop10RankExpensesThisYear) - 1) == $i){
                $titleEntityArr .= $getTop10RankExpensesThisYearInfo->sector_name;
                $amountEntityArr .= $this->convertToKhAmount($mulNum, $getTop10RankExpensesThisYearInfo->amount);
            }else{
                $titleEntityArr .= $getTop10RankExpensesThisYearInfo->sector_name.",";
                $amountEntityArr .= $this->convertToKhAmount($mulNum, $getTop10RankExpensesThisYearInfo->amount).",";
            }

            $calDevide100 = floatval($lastYearExpenseExplode[$i]) / 100;

            $data[] = array(
                "no" => ($i + 1),
                "sector_id" => $getTop10RankExpensesThisYearInfo->sector_id,
                "sector_name" => $getTop10RankExpensesThisYearInfo->sector_name,
                "amount" => $this->convertToKhAmount($mulNum, floatval($getTop10RankExpensesThisYearInfo->amount)),
                "amountLastYear" => floatval($lastYearExpenseExplode[$i]),
                "devide" => $calDevide100,
                "percentage" => floatval(number_format((intval($lastYearExpenseExplode[$i]) - intval($getTop10RankExpensesThisYearInfo->amount)) / intval($calDevide100),2)),
                "comparedResult" => ((intval($lastYearExpenseExplode[$i]) - intval($getTop10RankExpensesThisYearInfo->amount)) / intval($calDevide100))
            );
            $i++;
        }

        // this year
        // 1831540890, 49526010, 46130800, 68567641, 458613153
        // last year
        // 2071500000,769200000,141600000,626700000,1378800000
        
        // print_r($amountEntityArr);
        // dd($lastYearIncome);
        return response()->json(
            [
                "data" => $data,
                "sector" => explode(",", $titleEntityArr),
                "amountEntity" => explode(",", $amountEntityArr)
            ]
        );
    }

    public function incomeByEntity(){
        $mulNum = 1000000;
        // $query = DB::table("income as i")
        //             ->Select(DB::raw("sum('i.amount') as amount"))
        //             ->Join("entity as e", "i.entity_id", "e.id")
        //             ->Limit(10)
        //             ->GroupBy("i.entity_id")
        //             ->OrderBy(DB::raw("sum('i.amount')"))
        //             ->get();
        // $query = DB::table("income as i")
        //         ->Select("e.name as entity_name")
        //         ->Join("entity as e", "e.id", "i.entity_id")
        //         ->GroupBy("i.entity_id")
        //         ->OrderBy("amount", "desc")
        //         ->whereRaw("year(`issue_date`) = '2020'")
        //         ->Limit(10)
        //         ->get();
        $data = array();
        $getTop10RankIncomes = DB::table('income')
                                ->join('entity', 'entity.id' ,'=', 'income.entity_id')
                                ->whereRaw('year(`issue_date`) = ?', array(date('Y')))
                                ->select('entity.id as entity_id', DB::raw('sum(amount) as amount'), 'entity.name as entity_name')
                                ->groupBy('income.entity_id', 'entity.id',  'entity.name')
                                ->OrderBy("amount", "desc")
                                ->Limit(10)
                                ->get();
        
        $i = 0;
        $titleEntityArr = "";
        $amountEntityArr = "";
        foreach($getTop10RankIncomes as $getTop10RankIncome){
            if((count($getTop10RankIncomes) - 1) == $i){
                $titleEntityArr .= $getTop10RankIncome->entity_name;
                $amountEntityArr .= $this->convertToKhAmount($mulNum, $getTop10RankIncome->amount);
            }else{
                $titleEntityArr .= $getTop10RankIncome->entity_name.",";
                $amountEntityArr .= $this->convertToKhAmount($mulNum, $getTop10RankIncome->amount).",";
            }

            $data[] = array(
                "no" => ($i + 1),
                "entity_id" => $getTop10RankIncome->entity_id,
                "entity_name" => $getTop10RankIncome->entity_name,
                "amount" => $this->convertToKhAmount($mulNum, floatval($getTop10RankIncome->amount))
                // "comparedResult" => '800'
            );
            $i++;
        }
        return response()->json(
            [
                "data" => $data,
                "entity" => explode(",", $titleEntityArr),
                "amountEntity" => explode(",", $amountEntityArr)
            ]
        );
    }

    public function expenseByEntity(){
        $mulNum = 1000000;
        // $query = DB::table("income as i")
        //             ->Select(DB::raw("sum('i.amount') as amount"))
        //             ->Join("entity as e", "i.entity_id", "e.id")
        //             ->Limit(10)
        //             ->GroupBy("i.entity_id")
        //             ->OrderBy(DB::raw("sum('i.amount')"))
        //             ->get();
        // $query = DB::table("income as i")
        //         ->Select("e.name as entity_name")
        //         ->Join("entity as e", "e.id", "i.entity_id")
        //         ->GroupBy("i.entity_id")
        //         ->OrderBy("amount", "desc")
        //         ->whereRaw("year(`issue_date`) = '2020'")
        //         ->Limit(10)
        //         ->get();
        
        $getTop10RankIncomes = DB::table('incentive_to_officer')
                                ->join('entity', 'entity.id' ,'=', 'incentive_to_officer.entity_id')
                                ->whereRaw('year(`issue_from_date`) = ?', array(date('Y')))
                                ->select('entity.id as entity_id', DB::raw('sum(incentive) as amount'), 'entity.name as entity_name')
                                ->groupBy('incentive_to_officer.entity_id', 'entity.id',  'entity.name')
                                ->OrderBy("amount", "desc")
                                ->Limit(10)
                                ->get();
        
        $i = 0;
        $titleEntityArr = "";
        $amountEntityArr = "";
        $data = array();
        if(isset($getTop10RankIncomes)){
            foreach($getTop10RankIncomes as $getTop10RankIncome){
                if((count($getTop10RankIncomes) - 1) == $i){
                    $titleEntityArr .= $getTop10RankIncome->entity_name;
                    $amountEntityArr .= $this->convertToKhAmount($mulNum, $getTop10RankIncome->amount);
                }else{
                    $titleEntityArr .= $getTop10RankIncome->entity_name.",";
                    $amountEntityArr .= $this->convertToKhAmount($mulNum, $getTop10RankIncome->amount).",";
                }

                $data[] = array(
                    "no" => ($i + 1),
                    "entity_id" => $getTop10RankIncome->entity_id,
                    "entity_name" => $getTop10RankIncome->entity_name,
                    "amount" => $this->convertToKhAmount($mulNum, floatval($getTop10RankIncome->amount))
                    // "comparedResult" => '800'
                );
                $i++;
            }
        }
        return response()->json(
            [
                "data" => $data,
                "entity" => explode(",", $titleEntityArr),
                "amountEntity" => explode(",", $amountEntityArr)
            ]
        );
    }

    public function incomeTaxMonthly(){
        $incentive = DB::table("incentive")->get();
        $data = array(
            "data" => $incentive
        );
        return response()->json($data);
    }

    public function getIncomeOutcomeByQuarter(){
        $mulNum = 1000000;
        $exchangeRate = 4000;
        $totalOfficer = count(IncentiveOfficer::Where("status", 1)->get());
        $totalIncentive = round(Incentive::sum("total_incentive") / $mulNum);
        $totalIncome = round(Income::sum("amount") / $mulNum);
        $totalIncomeDollar = (Income::sum("amount") / $exchangeRate) / $mulNum;
        $totalExpense = round((IncentiveToOfficer::sum("incentive") + IncentiveToOfficer::sum("reminder_amount")) / $mulNum);
        $totalExpenseDollar = ((IncentiveToOfficer::sum("incentive") + IncentiveToOfficer::sum("reminder_amount")) / $exchangeRate) / $mulNum;
        $totalTaxIncentive = round(Incentive::sum("total_tax") / $mulNum);
        $totalRemainDollar = round(floatval($totalIncomeDollar) - floatval($totalExpenseDollar));
        $currentDate = date("Y-m-d");
        $getLast12MonthIncomes = Income::whereRaw('year(`issue_date`) = ?', array(date('Y')))
                        // ->where('issue_date', "<=", NOW())
                        ->Select(DB::raw("DATE_FORMAT(issue_date, '%m-%Y') as month, sum(amount) as total_amount"))
                        // ->select(\DB:raw("DATE_FORMAT(issue_date, '%m') as month, sum(amount) as total_income"))
                        ->groupBy(DB::raw("DATE_FORMAT(issue_date, '%m-%Y')"))
                        ->get();
        
        $getLast12MonthExpenses = IncentiveToOfficer::whereRaw('year(`issue_from_date`) = ?', array(date('Y')))
                        // ->where('issue_date', "<=", NOW())
                        // ->where('issue_date', '<=', '23:59:59')
                        ->Select(DB::raw("DATE_FORMAT(issue_from_date, '%m-%Y') as month, sum(incentive) as total_amount"))
                        // ->select(\DB:raw("DATE_FORMAT(issue_date, '%m') as month, sum(amount) as total_income"))
                        ->groupBy(DB::raw("DATE_FORMAT(issue_from_date, '%m-%Y')"))
                        ->get();
        
        // $dataIncomeArr = array();
        $dataIncomeArr = "";
        foreach($getLast12MonthIncomes as $data){
            // $dataIncomeArr[] = array(
            //     'month' => $data->month,
            //     'amount' => $data->total_amount
            // );
            // $dataIncomeArr[] = array(
            //     $data->total_amount
            // );
            $dataIncomeArr .= $this->convertToKhAmount($mulNum, $data->total_amount) . ",";
        }
        $arr = explode(",", $dataIncomeArr);
        $arrPop = array_pop($arr);
        // dd(implode(",", $arr));
        $implode = "";
        $dataOutComeStr = "";
        $dataOutcomeArr = array();
        foreach($getLast12MonthExpenses as $data){
            // $dataOutcomeArr[] = array(
            //     'month' => $data->month,
            //     'amount' => $data->total_amount
            // );
            // if(count($getLast12MonthExpenses) < 12){
            //     $dataOutComeStr .= $data->total_amount . ",";
            // }else{
            //     $dataOutComeStr .= $data->total_amount . ",";
            // }
            $dataOutComeStr .= $this->convertToKhAmount($mulNum, $data->total_amount) . ",";
        }
        
        $arrOutCome = explode(",", $dataOutComeStr);
        $lengthMonth = (12 - sizeof($arrOutCome));
        $strLenthMonth = '';
        for($k=0; $k < $lengthMonth + 1; $k++){
            if($lengthMonth == $k){
                $strLenthMonth .= '0';
            }else{
                $strLenthMonth .= '0,';
            }
        }
        
        $newStr = $dataOutComeStr.$strLenthMonth;
        // dd($newStr);

        // dd($strLenthMonth);

        

        $incomeByEntities = array();
        $outcomeByEntities = array();
        $incomeQuery = DB::table("income as i")
                        ->Select("e.id", DB::raw("sum(amount) as amount"))
                        ->Join("entity as e", "e.id", "=", "i.entity_id")
                        ->GroupBy("e.id")
                        ->Limit(10)
                        ->get();
        // dd($incomeQuery);
        $dataInfo = array(
            "totalOfficer" => $totalOfficer,
            "totalIncentive" => number_format($totalIncentive, 2),
            "totalIncome" => number_format($totalIncome, 2),
            "totalIncomeDollar" => number_format($totalIncomeDollar, 2),
            "totalExpense" => number_format($totalExpense, 2),
            "totalExpenseDollar" => number_format($totalExpenseDollar, 2),
            "totalTaxIncentive" => number_format($totalTaxIncentive,2),
            "totalRemain" => number_format((floatval($totalIncome) - floatval($totalExpense)),2),
            "totalRemainDollar" => number_format(($totalIncomeDollar - $totalExpenseDollar), 2),
            "dataIncome" => $arr,
            "dataOutcome"   => explode(",",$newStr)//[141866670.34375, 141866670.34375, 141866670.34375, 424600000, 424600000, 0, 0, 0, 0, 0]
        );
        $data = array(
            "data" => $dataInfo
        );
        return response()->json($data);

    }

    public function summaryIncomeOutcome(){
        // $dropTmpTabel = DB::raw("DROP TEMPORARY TABLE tmp");
        $dropTempTables = DB::unprepared(
            DB::raw("
                DROP TABLE IF EXISTS tmp
            ")
        );
        $createFieldTmp = DB::unprepared(
            DB::raw("
            CREATE TEMPORARY TABLE tmp(
            `entity_id` INT(11),
            `entity_code` VARCHAR(50),
            `entity` VARCHAR(255),
            `last_total_income` FLOAT(11),
            `total_income` FLOAT(11),
            `last_total_expense` FLOAT(11),
            `total_expense` FLOAT(11),
            `issue_from_date` DATETIME,
            `issue_to_date` DATETIME
            )
        "));

        DB::insert(DB::raw("
                        INSERT INTO tmp(entity_id, entity_code, entity, last_total_income, total_income,last_total_expense, total_expense, issue_from_date, issue_to_date)
                        SELECT 
                        e.`id`, 
                        e.`code`, 
                        e.name, 
                        (SELECT SUM(amount) FROM tbl_income WHERE DATE_FORMAT(issue_date, '%Y') < YEAR(CURDATE()) AND entity_id=i.entity_id) as sum_last_year,
                        (SELECT SUM(amount) FROM tbl_income WHERE DATE_FORMAT(issue_date, '%Y') = YEAR(CURDATE()) AND entity_id=i.entity_id) as sum_this_year,
                        (SELECT SUM(incentive) FROM tbl_incentive_to_officer WHERE DATE_FORMAT(issue_to_date, '%Y') < YEAR(CURDATE()) AND entity_id=i.entity_id),
                        (SELECT SUM(incentive) FROM tbl_incentive_to_officer WHERE DATE_FORMAT(issue_to_date, '%Y') = YEAR(CURDATE()) AND entity_id=i.entity_id),
                        i.issue_from_date, 
                        i.issue_from_date 
                        FROM tbl_incentive_to_officer AS i
                        JOIN tbl_entity AS e ON e.id = i.`entity_id`
                        WHERE e.is_active=1
                        GROUP BY i.entity_id
                    "));

        
        // DB::insert(DB::raw("
        //             INSERT INTO tmp(entity_id,entity_code, entity, total_expense, issue_from_date, issue_to_date)
        //             SELECT 
        //                 e2.`id`, 
        //                 e2.`code`, 
        //                 e2.`name`, 
        //                 i2o.incentive,
        //                 i2o.issue_from_date,
        //                 i2o.issue_to_date
        //             FROM `tbl_incentive_to_officer` AS i2o
        //             JOIN tbl_entity AS e2 ON e2.id = i2o.`entity_id`
        //             WHERE e2.is_active=1 AND i2o.entity_id=26
        //             GROUP BY i2o.entity_id, DATE_FORMAT(i2o.issue_to_date, '%Y')
        // "));

        // DB::insert(DB::raw("
        //             INSERT INTO tmp(entity_id, entity, total_expense, issue_from_date, issue_to_date)
        //             SELECT 
        //                 entity_id, 
        //                 entity, 
        //                 SUM(incentive),
        //                 issue_from_date,
        //                 issue_to_date
        //             FROM `tbl_incentive_to_officer`
        //             GROUP BY DATE_FORMAT(issue_to_date, '%Y')
        // "));
        
        // DB::select(DB::raw("
        //             UPDATE tmp
        //             SET tmp.total_expense = (
        //             SELECT 
        //                 DISTINCT i2o.incentive
        //             FROM `tbl_incentive_to_officer` AS i2o
        //             WHERE i2o.entity_id=tmp.entity_id
        //             GROUP BY i2o.entity_id, DATE_FORMAT(i2o.issue_to_date, '%Y')
        //             )
        // "));

        $total_income = DB::select(DB::raw("SELECT ROUND(SUM(total_income) / 1000000) as total_income FROM tmp"));
        $total_expense = DB::select(DB::raw("SELECT ROUND(SUM(total_expense) / 1000000) as total_expense FROM tmp"));
        $query = DB::select(DB::raw("SELECT * FROM tmp GROUP BY entity_id ORDER BY entity_id"));

        // $query = DB::select(DB::raw("SELECT sum(total_expense) FROM tmp"));
        // $resultData = array();
        // foreach($query as $result){
            // $resultQuery = DB::select(DB::raw("
            //     SELECT entity_code, entity, 
            //     total_income, 
            //         CASE WHEN DATE_FORMAT(issue_from_date, '%Y') < YEAR(CURDATE()) THEN SUM(total_income)
            //         ELSE
            //             SUM(total_income)
            //         END AS 
            //     sum_total_income,
            //     total_expense,
            //         CASE WHEN DATE_FORMAT(issue_from_date, '%Y') < YEAR(CURDATE()) THEN SUM(total_income) THEN SUM(total_expense)
            //         ELSE
            //             SUM(total_expense)
            //         END AS 
            //     sum_total_expense
            //     FROM tmp GROUP BY issue_to_date
            // "));
            // $resultQuery = DB::select(DB::raw("
            //     SELECT entity_code, entity, 
            //     total_income, 
            //         CASE WHEN DATE_FORMAT(issue_from_date, '%Y') < YEAR(CURDATE()) THEN total_income
            //         END AS 
            //     total_income,
            //     total_expense,
            //         CASE WHEN DATE_FORMAT(issue_from_date, '%Y') < YEAR(CURDATE()) THEN total_expense
            //         END AS 
            //     total_expense
            //     FROM tmp GROUP BY entity_id
            // "));

        $resultQuery = DB::select(DB::raw("
            SELECT 
            DATE_FORMAT(issue_from_date, '%Y') as year, 
            entity_id,
            entity_code, 
            entity,
            last_total_income,
            total_income,
            last_total_expense,
            total_expense,
            issue_to_date
            FROM tmp
        "));
        // $resultQuery = DB::select(DB::raw("
        //     SELECT 
        //     DATE_FORMAT(issue_from_date, '%Y') as year, 
        //     entity_id,
        //     entity_code, 
        //     entity,
        //     CASE WHEN DATE_FORMAT(issue_from_date, '%Y') < YEAR(CURDATE()) THEN sum(total_income)
        //     END AS last_total_income,
        //     CASE WHEN DATE_FORMAT(issue_from_date, '%Y') = YEAR(CURDATE()) THEN sum(total_income)
        //     END AS this_total_income,
        //     total_expense,
        //     issue_to_date
        //     FROM tmp
        // "));
                
        //     $lastYearGroup = 0;
        //     $thisYearGroup = 0;
        //     $totalSumYear = 0;
        //     $resultData[] = array(
        //         'lastYearGroup' => $querylastYearGroup,
        //         'thisYearGroup' => $thisYearGroup,
        //         'totalSumYear' => $totalSumYear
        //     );
        // }

        // dd($resultData);
        $data = array(
            "data" => $resultQuery
        );
        // dd($data);
        return response()->json($data);
    }

    public function getTopRankEntity(){
        $query = DB::table("entity")->OrderBy("order_level")->Limit(10)->get();
        $entityData = array();
        foreach($query as $row){
            $topIncome = DB::table("income")->Where("entity_id", $row->id)
                         ->sum("amount");
            $entityData[] = array(
                // "entity" => $row->name,
                // "income" => $topIncome
                'customerType' => $row->name, 
                'counts' => $topIncome . '៛', 
                'color' => 'primary'
            );
        }
        $data = array(
            "data" => $entityData
        );
        return response()->json($data);
    }

    public function convertToExcelByBank(Request $request){
        $input = $request->all();
        $bankId = $input["bankId"];
        $html = view('GDNTExcel');
        $filename = "./upload/GDNT_Annex_Excel.xls";
        file_put_contents($filename, $html);
        // $dataIncentive = $this->getFormIncentive(32);
        return true;
    }
}
