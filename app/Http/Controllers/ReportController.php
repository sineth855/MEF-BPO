<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incentive;
use App\Models\IncentiveOfficer;
use App\Models\Entity;
use App\Models\IncentiveToOfficer;
use App\Models\Income;
use App\Models\Expense;
use App\Http\Controllers\IncentiveController;
use Auth;
use DB;
use Schema;
use DateTime;
use CommonService;

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

    public function summary(Request $request){
        $input = $request->all();
        $filter = date("Y-m-d", strtotime($input["filter"]));
        $year = $input["filter"]; 
        $fromPeriod = $year.'-01-01';
        $toPeriod = $year.'-12-01';
        $lastYearfromPeriod = ($year-1).'-01-01';
        $lastYeartoPeriod = ($year-1).'-12-01';     
        // #################
        $mulNum = 1000000;
        $exchangeRate = 4000;
        $totalOfficer = count(IncentiveOfficer::Where("status", 1)->get());
        $totalIncentive = round(Incentive::sum("total_incentive") / $mulNum);
        $totalIncome = round(Income::sum("amount") / $mulNum);
        $totalIncomeDollar = (Income::sum("amount") / $exchangeRate) / $mulNum;
        $totalExpense = round(IncentiveToOfficer::sum("incentive") / $mulNum);
        $totalExpenseDollar = (IncentiveToOfficer::sum("incentive") / $exchangeRate) / $mulNum;
        $totalTaxIncentive = round(Incentive::sum("total_tax") / $mulNum);
        $totalRemainDollar = round(floatval($totalIncomeDollar) - floatval($totalExpenseDollar));

        $getOfficers = DB::table("incentive_to_officer as i2o")
                        ->select(DB::raw("count(DISTINCT officer_id) as number_officer"), DB::raw("DATE_FORMAT(issue_from_date, '%Y') as year"))
                        ->join("incentive_officer as io", "io.id", "=", "i2o.officer_id")
                        ->where("io.status", 1)
                        ->groupBy(DB::raw("DATE_FORMAT(issue_from_date, '%Y')"))
                        ->orderBy("year")
                        ->get();

        $getThisYearIncomes = Income::whereRaw('year(`issue_date`) = ?', array($year))
                                ->Select(DB::raw("DATE_FORMAT(issue_date, '%m-%Y') as month, sum(amount) as total_amount"))
                                ->groupBy(DB::raw("DATE_FORMAT(issue_date, '%m-%Y')"))
                                ->get();
        
        $getLastYearIncomes = Income::whereRaw('year(`issue_date`) = YEAR(DATE_SUB("'.$filter.'", INTERVAL 1 YEAR))')
                                ->Select(DB::raw("DATE_FORMAT(issue_date, '%m-%Y') as month, sum(amount) as total_amount"))
                                ->groupBy(DB::raw("DATE_FORMAT(issue_date, '%m-%Y')"))
                                ->get();

        $quarterIncomeThisYear = DB::table("income")->SELECT(DB::raw("QUARTER(`issue_date`) as quarter, sum(amount) as amount"))
                                                    ->groupBy(DB::raw("QUARTER(`issue_date`)"))
                                                    ->whereRaw('year(`issue_date`) = ?', array($year))
                                                    ->get();

        $getLastDateIncomeThisYear = DB::table("income")->SELECT('issue_date')
                                                    ->whereRaw('year(`issue_date`) = ?', array($year-1))
                                                    ->orderBy('issue_date', "desc")
                                                    ->first();
        
        $quarterIncomeLastYear = DB::table("income")->SELECT(DB::raw("QUARTER(`issue_date`) as quarter, sum(amount) as amount"))
                                                    ->groupBy(DB::raw("QUARTER(`issue_date`)"))
                                                    ->whereRaw('year(`issue_date`) = YEAR(DATE_SUB("'.$filter.'", INTERVAL 1 YEAR))')
                                                    ->get();

        $quarterExpenseThisYears = IncentiveToOfficer::whereBetween('issue_from_date', [$fromPeriod, $toPeriod])
                                                    ->Select(DB::raw("issue_from_date as from_date, issue_to_date as to_date, SUM(incentive) as incentive, SUM(reminder_amount) as reminder_incentive, (SUM(incentive)+SUM(reminder_amount)) as total_incentive"))
                                                    ->groupBy(DB::raw("DATE_FORMAT(issue_from_date, '%m-%Y')"))
                                                    ->OrderBy('issue_from_date', 'ASC')
                                                    ->OrderBy('issue_to_date', 'ASC')
                                                    ->get();

                                                   
        $getLastDateExpThisYear = IncentiveToOfficer::whereBetween('issue_from_date', [$fromPeriod, $toPeriod])
                                                    ->Select("issue_to_date")
                                                    ->OrderBy('issue_to_date', 'DESC')
                                                    ->first();
        
        if($getLastDateExpThisYear){
            $getLastDateExpThisYear = IncentiveToOfficer::whereBetween('issue_from_date', [$fromPeriod, $toPeriod])
                                                    ->Select("issue_to_date")
                                                    ->OrderBy('issue_to_date', 'DESC')
                                                    ->first();
        }else{
            $getLastDateExpThisYear = IncentiveToOfficer::Select("issue_to_date")
                                                        ->whereRaw('year(`issue_to_date`) = YEAR(DATE_SUB("'.$filter.'", INTERVAL 1 YEAR))')
                                                        ->OrderBy('issue_to_date', 'DESC')
                                                        ->first();
        }
        

        $quarterExpenseLastYears = IncentiveToOfficer::whereBetween('issue_from_date', [$lastYearfromPeriod, $lastYeartoPeriod])
                                                    ->Select(DB::raw("issue_from_date as from_date, issue_to_date as to_date, SUM(incentive) as incentive, SUM(reminder_amount) as reminder_incentive, (SUM(incentive)+SUM(reminder_amount)) as total_incentive"))
                                                    ->groupBy(DB::raw("DATE_FORMAT(issue_from_date, '%m-%Y')"))
                                                    ->OrderBy('issue_from_date', 'ASC')
                                                    ->OrderBy('issue_to_date', 'ASC')
                                                    ->get();
    

        // #### Income By Quarter This Year
        $dataIncomThisYear = "";
        $l=0;
        $countIncomeThisYear = count($quarterIncomeThisYear);
        if($countIncomeThisYear > 0){
            foreach($quarterIncomeThisYear as $quarterIncomeThisYearInfo){
                if(($countIncomeThisYear - 1)  == $l){
                    $dataIncomThisYear .= $this->convertToKhAmount($mulNum, $quarterIncomeThisYearInfo->amount);
                }else{
                    $dataIncomThisYear .= $this->convertToKhAmount($mulNum, $quarterIncomeThisYearInfo->amount).',';
                }
                $l++;
            }
        }else{
            $dataIncomThisYear = "0,0,0,0";
        }

        // #### Income By Quarter Last Year
        $dataIncomLastYear = ""; 
        $m=0;
        $countIncomeLastYear = count($quarterIncomeLastYear);
        if($countIncomeLastYear > 0){
            foreach($quarterIncomeLastYear as $quarterIncomeLastYearInfo){
                if(($countIncomeLastYear - 1)  == $m){
                    $dataIncomLastYear .= $this->convertToKhAmount($mulNum, $quarterIncomeLastYearInfo->amount);
                }else{
                    $dataIncomLastYear .= $this->convertToKhAmount($mulNum, $quarterIncomeLastYearInfo->amount).',';
                }
                $m++;
            }
        }else{
            $dataIncomLastYear = "0,0,0,0";
        }
        
        // Expense By Quarter This year
        $strExThisYear = "0,0,0,0";
        if(count($quarterExpenseThisYears) > 0){
            $dataExpThisYear = ""; 
            foreach($quarterExpenseThisYears as $quarterExpenseThisYear){
                $date1 = $quarterExpenseThisYear->from_date;
                $date2 = $quarterExpenseThisYear->to_date;
                $ts1 =strtotime($date1); 
                $ts2 = strtotime($date2); 
                $year1 = date('Y', $ts1); 
                $year2 = date('Y', $ts2); 
                $month1 = date('m', $ts1); 
                $month2 = date('m', $ts2); 
                $diff = (($year2 - $year1) * 12) + ($month2 - $month1) ;
                if($diff > 0){
                    $j=1;
                    for($j=0; $j < ($diff + 1); $j++){
                        if($j > 1){
                            if(date("m",strtotime($quarterExpenseThisYear->from_date)) < 10){
                                $newDate = '0'.date("m",strtotime($quarterExpenseThisYear->from_date)) + $j;
                            }else{
                                $newDate = date("m",strtotime($quarterExpenseThisYear->from_date)) + $j;
                            }
                            $dataExpThisYear .= $this->convertToKhAmount($mulNum, $quarterExpenseThisYear->incentive) . ",";
                        }else{
                            if(date("m",strtotime($quarterExpenseThisYear->from_date)) < 10){
                                $newDate = '0'.date("m",strtotime($quarterExpenseThisYear->from_date)) + $j;
                            }else{
                                $newDate = date("m",strtotime($quarterExpenseThisYear->from_date)) + $j;
                            }
                            $dataExpThisYear .= $this->convertToKhAmount($mulNum, $quarterExpenseThisYear->incentive) . ",";
                        }
                    }
                }else{
                    $dataExpThisYear .= $this->convertToKhAmount($mulNum, $quarterExpenseThisYear->incentive) . ",";
                }
            }
            
            // If Data Exp is not enought will be add more value 0 to full fill the data
            $numExpThisYear = count(explode(',', $dataExpThisYear));
            if($numExpThisYear < 12){
                $extraLoopExpThisYear = 12 - $numExpThisYear;
                for($ll = 0; $ll < ($extraLoopExpThisYear + 1); $ll++){
                    $dataExpThisYear .= "0,";
                }
            }
            // $dataExpThisYear2 = "1,2,3,4,5,6,7,8,9,10,11,12,";
            $explodedataExpThisYear = explode(',', $dataExpThisYear);
            array_pop($explodedataExpThisYear);
            $k1 = "";
            $k2 = "";
            $k3 = "";
            $k4 = "";
            $sum1 = 0;
            for($jj = 0; $jj < 3; $jj++){
                $sum1 += $explodedataExpThisYear[$jj];
                $k1 = $sum1.',';
            }
            $sum2 = 0;
            for($jj = 3; $jj < 6; $jj++){
                $sum2 += $explodedataExpThisYear[$jj];
                $k2 = $sum2.',';
            }
            $sum3 = 0;
            for($jj = 6; $jj < 9; $jj++){
                $sum3 += $explodedataExpThisYear[$jj];
                $k3 = $sum3.',';
            }
            $sum4 = 0;
            for($jj = 9; $jj < 12; $jj++){
                $sum4 += $explodedataExpThisYear[$jj];
                $k4 = $sum4;
            }
            $strExThisYear = $k1.$k2.$k3.$k4;
        }else{
            $dataExpenseThisYear = "0,0,0,0";
        }

        // Expense By Quarter Last Year
        $strExLastYear = "0,0,0,0";
        $getLastDateOfExpLastYear = "";
        if(count($quarterExpenseLastYears) > 0){
            $dataExpLastYear = ""; 
            foreach($quarterExpenseLastYears as $quarterExpenseLastYear){
                $date1 = $quarterExpenseLastYear->from_date;
                $date2 = $quarterExpenseLastYear->to_date;
                $ts1 =strtotime($date1); 
                $ts2 = strtotime($date2); 
                $year1 = date('Y', $ts1); 
                $year2 = date('Y', $ts2); 
                $month1 = date('m', $ts1); 
                $month2 = date('m', $ts2); 
                $diff = (($year2 - $year1) * 12) + ($month2 - $month1) ;
                if($diff > 0){
                    $j=1;
                    for($j=0; $j < ($diff + 1); $j++){
                        if($j > 1){
                            if(date("m",strtotime($quarterExpenseLastYear->from_date)) < 10){
                                $newDate = '0'.date("m",strtotime($quarterExpenseLastYear->from_date)) + $j;
                            }else{
                                $newDate = date("m",strtotime($quarterExpenseLastYear->from_date)) + $j;
                            }
                            $dataExpLastYear .= $this->convertToKhAmount($mulNum, $quarterExpenseLastYear->incentive) . ",";
                        }else{
                            if(date("m",strtotime($quarterExpenseLastYear->from_date)) < 10){
                                $newDate = '0'.date("m",strtotime($quarterExpenseLastYear->from_date)) + $j;
                            }else{
                                $newDate = date("m",strtotime($quarterExpenseLastYear->from_date)) + $j;
                            }
                            $dataExpLastYear .= $this->convertToKhAmount($mulNum, $quarterExpenseLastYear->incentive) . ",";
                        }
                    }
                }else{
                    $dataExpLastYear .= $this->convertToKhAmount($mulNum, $quarterExpenseLastYear->incentive) . ",";
                }
            }
            
            // If Data Exp is not enought will be add more value 0 to full fill the data
            $numExpLastYear = count(explode(',', $dataExpLastYear));
            if($numExpLastYear < 12){
                $extraLoopExpLastYear = 12 - $numExpLastYear;
                for($ll = 0; $ll < ($extraLoopExpLastYear + 1); $ll++){
                    $dataExpLastYear .= "0,";
                }
            }
            // $dataExpLastYear2 = "1,2,3,4,5,6,7,8,9,10,11,12,";
            $explodedataExpLastYear = explode(',', $dataExpLastYear);
            array_pop($explodedataExpLastYear);
            $k1 = "";
            $k2 = "";
            $k3 = "";
            $k4 = "";
            $sum1 = 0;
            for($jj = 0; $jj < 3; $jj++){
                $sum1 += $explodedataExpLastYear[$jj];
                $k1 = $sum1.',';
            }
            $sum2 = 0;
            for($jj = 3; $jj < 6; $jj++){
                $sum2 += $explodedataExpLastYear[$jj];
                $k2 = $sum2.',';
            }
            $sum3 = 0;
            for($jj = 6; $jj < 9; $jj++){
                $sum3 += $explodedataExpLastYear[$jj];
                $k3 = $sum3.',';
            }
            $sum4 = 0;
            for($jj = 9; $jj < 12; $jj++){
                $sum4 += $explodedataExpLastYear[$jj];
                $k4 = $sum4;
            }
            $strExLastYear = $k1.$k2.$k3.$k4;
        }else{
            $dataExpenseLastYear = "0,0,0,0";
        }
        // Convert data to Quarterly
        $quaterThisYearIncome = explode(",", $dataIncomThisYear);
        $quaterLastYearIncome = explode(",", $dataIncomLastYear);
        $quaterThisYearExpense = explode(",", $strExThisYear);
        $quaterLastYearExpense = explode(",", $strExLastYear);
        // dd(count($quaterLastYearExpense));
        $g = 0;

        // ### Remain Amount This Year & Last Year
        $remainAmountThisYear = array(($quaterThisYearIncome[0] - $quaterThisYearExpense[0]),($quaterThisYearIncome[1] - $quaterThisYearExpense[1]),($quaterThisYearIncome[2] - $quaterThisYearExpense[2]),($quaterThisYearIncome[3] - $quaterThisYearExpense[3]));
        $remainAmountLastYear = array(($quaterLastYearIncome[0] - $quaterLastYearExpense[0]),($quaterLastYearIncome[1] - $quaterLastYearExpense[1]),($quaterLastYearIncome[2] - $quaterLastYearExpense[2]),($quaterLastYearIncome[3] - $quaterLastYearExpense[3]));

        // Incentive Variable
        $d = "";
        $m = "";
        $y = "";
        if($getLastDateExpThisYear){
            $d = $this->convertToKhmerNumber(date("d", strtotime($getLastDateExpThisYear->issue_to_date)));
            $m = $this->convertToKhmerNumber(date("m", strtotime($getLastDateExpThisYear->issue_to_date)));
            $y = $this->convertToKhmerNumber(date("y", strtotime($getLastDateExpThisYear->issue_to_date)));
        }else{
            $d = $this->convertToKhmerNumber(date("d", strtotime(date("Y-m-d"))));
            $m = $this->convertToKhmerNumber(date("m", strtotime(date("Y-m-d"))));
            $y = $this->convertToKhmerNumber(date("y", strtotime(date("Y-m-d"))));
        }
        
        $dataInfo = array(
            "quaterThisYearIncome" => $quaterThisYearIncome,
            "quaterLastYearIncome" => $quaterLastYearIncome,
            "quaterThisYearExpense" => $quaterThisYearExpense,
            "quaterLastYearExpense" => $quaterLastYearExpense,
            "remainAmountThisYear" => $remainAmountThisYear,
            "remainAmountLastYear" => $remainAmountLastYear,
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
            "khmer_date" => config_khmerdate,
            "currentDay" => $this->convertToKhmerDate(date("D")),
            "currentDate" => $this->convertToKhmerNumber(date("d")),
            "currentMonth" => $this->convertKhMonth(date("m")),
            "currentYear" => $this->convertToKhmerNumber(date("Y")),

            "currentDateOfficer" => "គិតត្រឹមថ្ងៃទី ".$d." ខែ ".$m." ឆ្នាំ".$y,
            "lastUpdatedDateIncome" => "គិតត្រឹមថ្ងៃទី ".$this->convertToKhmerNumber(date("d", strtotime($getLastDateIncomeThisYear?$getLastDateIncomeThisYear->issue_date:date("Y-m-d"))))." ខែ ".$this->convertKhMonth(date("m", strtotime($getLastDateIncomeThisYear?$getLastDateIncomeThisYear->issue_date:date("Y-m-d"))))." ឆ្នាំ".$this->convertToKhmerNumber(date("Y", strtotime($getLastDateIncomeThisYear?$getLastDateIncomeThisYear->issue_date:date("Y-m-d")))),
            "lastUpdatedDateExp" => "គិតត្រឹមថ្ងៃទី ".$d." ខែ ".$m." ឆ្នាំ".$y,
            
            // "currentDateOfficer" => "គិតត្រឹមថ្ងៃទី ".$this->convertToKhmerNumber(date("d", strtotime($getLastDateExpThisYear->issue_to_date?$getLastDateExpThisYear->issue_to_date:$getLastDateExpThisYear2->issue_to_date)))." ខែ ".$this->convertKhMonth(date("m", strtotime($getLastDateExpThisYear->issue_to_date?$getLastDateExpThisYear->issue_to_date:$getLastDateExpThisYear2->issue_to_date)))." ឆ្នាំ".$this->convertToKhmerNumber(date("Y", strtotime($getLastDateExpThisYear->issue_to_date?$getLastDateExpThisYear->issue_to_date:$getLastDateExpThisYear2->issue_to_date))),
            // // "lastUpdatedDateIncome" => "គិតត្រឹមថ្ងៃទី ".$this->convertToKhmerNumber(date("d", strtotime($getLastDateIncomeThisYear->issue_date?$getLastDateIncomeThisYear->issue_date:date("Y-m-d"))))." ខែ ".$this->convertKhMonth(date("m", strtotime($getLastDateIncomeThisYear->issue_date?$getLastDateIncomeThisYear->issue_date:date("Y-m-d"))))." ឆ្នាំ".$this->convertToKhmerNumber(date("Y", strtotime($getLastDateIncomeThisYear->issue_date?$getLastDateIncomeThisYear->issue_date:date("Y-m-d")))),
            // "lastUpdatedDateIncome" => "គិតត្រឹមថ្ងៃទី ".$this->convertToKhmerNumber(date("d", strtotime($getLastDateIncomeThisYear?$getLastDateIncomeThisYear->issue_date:date("Y-m-d"))))." ខែ ".$this->convertKhMonth(date("m", strtotime($getLastDateIncomeThisYear?$getLastDateIncomeThisYear->issue_date:date("Y-m-d"))))." ឆ្នាំ".$this->convertToKhmerNumber(date("Y", strtotime($getLastDateIncomeThisYear?$getLastDateIncomeThisYear->issue_date:date("Y-m-d")))),
            // "lastUpdatedDateExp" => "គិតត្រឹមថ្ងៃទី ".$this->convertToKhmerNumber(date("d", strtotime($getLastDateExpThisYear->issue_to_date?$getLastDateExpThisYear->issue_to_date:$getLastDateExpThisYear2->issue_to_date)))." ខែ ".$this->convertKhMonth(date("m", strtotime($getLastDateExpThisYear->issue_to_date?$getLastDateExpThisYear->issue_to_date:$getLastDateExpThisYear2->issue_to_date)))." ឆ្នាំ".$this->convertToKhmerNumber(date("Y", strtotime($getLastDateExpThisYear->issue_to_date?$getLastDateExpThisYear->issue_to_date:$getLastDateExpThisYear2->issue_to_date))),
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

    public function incomeBySector(Request $request){
        $input = $request->all();
        $year = $input["year"];
        $convertDate = date("Y-m-d", strtotime($year));
        // dd($convertDate);
        $mulNum = 1000000;
        $getTop10RankIncomes = DB::table('income')
                                ->join('entity', 'entity.id' ,'=', 'income.entity_id')
                                ->join('sector', 'sector.id' ,'=' ,'entity.sector_id')
                                ->whereRaw('year(`issue_date`) = ?', array($year))
                                ->select('sector.name as sector_name', 'entity.sector_id as sector_id', DB::raw('sum(amount) as amount'))
                                ->groupBy('sector.name', 'entity.sector_id')
                                ->OrderBy("entity.sector_id", "desc")
                                // ->Limit(10)
                                ->get();
                              
        $getTop10RankIncomesLastYear = DB::table('income')
                                ->join('entity', 'entity.id' ,'=', 'income.entity_id')
                                ->join('sector', 'sector.id' ,'=' ,'entity.sector_id')
                                ->whereRaw('year(`issue_date`) = YEAR(DATE_SUB('.$convertDate.', INTERVAL 1 YEAR))')
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
        if(count($getTop10RankIncomesLastYear) > 0){
            foreach($getTop10RankIncomesLastYear as $getTop10RankIncomesLastYearInfo){
                if((count($getTop10RankIncomesLastYear) - 1) == $k){
                    $lastYearIncome .= $getTop10RankIncomesLastYearInfo->amount;
                }else{
                    $lastYearIncome .= $getTop10RankIncomesLastYearInfo->amount.",";
                }
                $k++;
            }
        }else{
            $lastYearIncome = "0,0,0,0,";
        }
        
        $lastYearIncomeExplode = explode(",", $lastYearIncome);
        // dd($getTop10RankIncomesLastYear);
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
            // if(){
            // }else{
                
            // }

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

    public function getIncomeOutcomeByQuarter(Request $request){
        $year = $request["year"];
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
        
        $fromPeriod = $year.'-01-01';
        $toPeriod = $year.'-12-01';

        $getLast12MonthIncomes = Income::whereRaw('year(`issue_date`) = ?', array($year))
                        ->Select(DB::raw("DATE_FORMAT(issue_date, '%m-%Y') as month, sum(amount) as total_amount"))
                        ->groupBy(DB::raw("DATE_FORMAT(issue_date, '%m-%Y')"))
                        ->get();
        
        $getLast12MonthExpenses = IncentiveToOfficer::whereBetween('issue_from_date', [$fromPeriod, $toPeriod])
                        ->Select(DB::raw("issue_from_date as from_date, issue_to_date as to_date, SUM(incentive) as incentive, SUM(reminder_amount) as reminder_incentive, (SUM(incentive)+SUM(reminder_amount)) as total_incentive"))
                        ->groupBy(DB::raw("DATE_FORMAT(issue_from_date, '%m-%Y')"))
                        ->OrderBy('issue_from_date', 'ASC')
                        ->OrderBy('issue_to_date', 'ASC')
                        ->get();
        
        
        $dataIncomeArr = "";
        foreach($getLast12MonthIncomes as $data){
            $dataIncomeArr .= $this->convertToKhAmount($mulNum, $data->total_amount) . ",";
        }
        $arr = explode(",", $dataIncomeArr);
        $arrPop = array_pop($arr);

        $implode = "";
        $dataOutComeStr = "";
        $dataOutcomeArr = array();

        $dataMonthlyExpenses = array();
        foreach($getLast12MonthExpenses as $data){
            $date1 = $data->from_date;
            $date2 = $data->to_date;
            $ts1 =strtotime($date1); 
            $ts2 = strtotime($date2); 
            $year1 = date('Y', $ts1); 
            $year2 = date('Y', $ts2); 
            $month1 = date('m', $ts1); 
            $month2 = date('m', $ts2); 
            $diff = (($year2 - $year1) * 12) + ($month2 - $month1) ;
            if($diff > 0){
                $j=1;
                for($j=0; $j < ($diff + 1); $j++){
                    // // $from_date = $from_date;
                    // // $to_date = $to_date;
                    if($j > 1){
                        if(date("m",strtotime($data->from_date)) < 10){
                            $newDate = '0'.date("m",strtotime($data->from_date)) + $j;
                        }else{
                            $newDate = date("m",strtotime($data->from_date)) + $j;
                        }
                        $dataOutComeStr .= $this->convertToKhAmount($mulNum, $data->incentive) . ",";
                    }else{
                        if(date("m",strtotime($data->from_date)) < 10){
                            $newDate = '0'.date("m",strtotime($data->from_date)) + $j;
                        }else{
                            $newDate = date("m",strtotime($data->from_date)) + $j;
                        }
                        $dataOutComeStr .= $this->convertToKhAmount($mulNum, $data->incentive) . ",";
                    }
                }
            }else{
                $dataOutComeStr .= $this->convertToKhAmount($mulNum, $data->incentive) . ",";
            }

            $dataMonthlyExpenses[] = array(
                "from_date" => $data->from_date,
                "to_date" => $data->to_date,
                "countDate" => $diff,
                "incentive" => $data->incentive,
                "reminder_incentive" => $data->reminder_incentive,
                "total_incentive" => $data->total_incentive
            );
            
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
        $dateOutcome = explode(",",$newStr);
        array_pop($dateOutcome);
        $incomeByEntities = array();
        $outcomeByEntities = array();
        $incomeQuery = DB::table("income as i")
                        ->Select("e.id", DB::raw("sum(amount) as amount"))
                        ->Join("entity as e", "e.id", "=", "i.entity_id")
                        ->GroupBy("e.id")
                        ->Limit(10)
                        ->get();

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
            "dataOutcome" => $dateOutcome//[141866670.34375, 141866670.34375, 141866670.34375, 424600000, 424600000, 0, 0, 0, 0, 0]
        );
        $data = array(
            "data" => $dataInfo
        );
        return response()->json($data);

    }

    public function summaryIncomeOutcome(){
        // $dropTmpTabel = DB::raw("DROP TEMPORARY TABLE tmp");
        // $dropTempTables = DB::unprepared(
        //     DB::raw("
        //         DROP TABLE IF EXISTS tmp
        //     ")
        // );
        // $createFieldTmp = DB::unprepared(
        //     DB::raw("
        //     CREATE TEMPORARY TABLE tmp(
        //     `entity_id` INT(11),
        //     `entity_code` VARCHAR(50),
        //     `entity` VARCHAR(255),
        //     `last_total_income` FLOAT(11),
        //     `total_income` FLOAT(11),
        //     `last_total_expense` FLOAT(11),
        //     `total_expense` FLOAT(11),
        //     `issue_from_date` DATETIME,
        //     `issue_to_date` DATETIME
        //     )
        // "));

        // // $ddd = DB::insert(DB::raw("
        // //                 INSERT INTO tmp(entity_id, entity_code, entity, last_total_income, total_income,last_total_expense, total_expense, issue_from_date, issue_to_date)
        // //                 SELECT 
        // //                 e.`id`, 
        // //                 e.`code`, 
        // //                 e.name, 
        // //                 (SELECT SUM(amount) FROM tbl_income WHERE DATE_FORMAT(issue_date, '%Y') < YEAR(CURDATE()) AND entity_id=i.entity_id) as sum_last_year,
        // //                 (SELECT SUM(amount) FROM tbl_income WHERE DATE_FORMAT(issue_date, '%Y') = YEAR(CURDATE()) AND entity_id=i.entity_id) as sum_this_year,
        // //                 (SELECT SUM(incentive) FROM tbl_incentive_to_officer WHERE DATE_FORMAT(issue_to_date, '%Y') < YEAR(CURDATE()) AND entity_id=i.entity_id),
        // //                 (SELECT SUM(incentive) FROM tbl_incentive_to_officer WHERE DATE_FORMAT(issue_to_date, '%Y') = YEAR(CURDATE()) AND entity_id=i.entity_id),
        // //                 i.issue_from_date, 
        // //                 i.issue_from_date 
        // //                 FROM tbl_incentive_to_officer AS i
        // //                 JOIN tbl_entity AS e ON e.id = i.`entity_id`
        // //                 WHERE e.is_active=1
        // //                 GROUP BY i.entity_id
        // //             "));

        // $total_income = DB::select(DB::raw("SELECT ROUND(SUM(total_income) / 1000000) as total_income FROM tmp"));
        // $total_expense = DB::select(DB::raw("SELECT ROUND(SUM(total_expense) / 1000000) as total_expense FROM tmp"));
        // $query = DB::select(DB::raw("SELECT * FROM tmp GROUP BY entity_id config_order BY entity_id"));

        // $resultQuery = DB::select(DB::raw("
        //     SELECT 
        //     DATE_FORMAT(issue_from_date, '%Y') as year, 
        //     entity_id,
        //     entity_code, 
        //     entity,
        //     last_total_income,
        //     total_income,
        //     last_total_expense,
        //     total_expense,
        //     issue_to_date
        //     FROM tmp
        // "));
        
        $entities = Entity::where("is_active", 1)->OrderBy("order_level")->get();
        $entityArr = array();
        foreach($entities as $entity){
            $entityId= $entity->id;
            $sum_last_year = Income::where(DB::raw("DATE_FORMAT(issue_date, '%Y') < YEAR(CURDATE() AND entity_id=".$entityId.")"))->sum("amount");
            //"SELECT SUM(amount) as sum_last_year FROM tbl_income WHERE DATE_FORMAT(issue_date, '%Y') < YEAR(CURDATE()) AND entity_id=1)"));
            $sum_this_year = Income::whereYear('issue_date', "=" ,date('Y'))->sum("amount");
            $incentiveLastYear = IncentiveToOfficer::whereYear("issue_from_date", "<" , date('Y'))->where("entity_id", $entityId)->sum("incentive");
            // DB::raw("SELECT SUM(incentive) FROM tbl_incentive_to_officer WHERE DATE_FORMAT(issue_to_date, '%Y') < YEAR(CURDATE()) AND entity_id=".$entityId.")");
            $incentiveThisYear = IncentiveToOfficer::whereYear("issue_from_date", "=" , date('Y'))->where("entity_id", $entityId)->sum("incentive");

            $entityArr[] = array(
                "year" => "2020",
                "entity_id" => $entity->id,
                "entity_code" => $entity->code,
                "entity" => $entity->name,
                "last_total_income" => $sum_last_year,
                "total_income" => $sum_this_year,
                "last_total_expense" => $incentiveLastYear,
                "total_expense" => $incentiveThisYear,
                "issue_from_date" => "",
                "issue_to_date" => ""
            );
        }

        $data = array(
            "data" => $entityArr
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

    public function convertAnnexLMToExcel(Request $request){
        $input = $request->all();
        // dd($input);
        $incentiveId = $input["incentive_id"];
        $incentiveInfo = $this->getFormIncentive($incentiveId);
        $html = view('template/AnnexToLM')->with("incentiveInfo", $incentiveInfo);
        $filename = "./upload/".$incentiveInfo["data"]["general"]["issue_from_date"]."_annex_lm.xls";
        file_put_contents($filename, $html);

        $info = array(
            "url" => "../../../upload/".$incentiveInfo["data"]["general"]["issue_from_date"]."_annex_lm.xls"
        );

        $data = array(
            "success" => true,
            "data" => $info
        );
        return $data;
    }
    
    public function convertAnnexBankToExcel(Request $request){
        $input = $request->all();
        // dd($input);
        $incentiveId = $input["incentive_id"];
        $bankId = $input["bank_id"];
        $bankName = $input["bank_name"];
        $incentiveInfo = $this->getFormIncentive($incentiveId);
        $html = view('template/AnnexToBank')->with("incentiveInfo", $incentiveInfo);
        $filename = "./upload/".$incentiveInfo["data"]["general"]["issue_from_date"]."_annex_bank_".$bankName.".xls";
        file_put_contents($filename, $html);

        $info = array(
            "url" => "../../../upload/".$incentiveInfo["data"]["general"]["issue_from_date"]."_annex_bank_".$bankName.".xls"
        );

        $data = array(
            "success" => true,
            "data" => $info
        );
        return $data;
    }

    public function convertAnnexGDNTToExcel(Request $request){
        $input = $request->all();
        // dd($input);
        $incentiveId = $input["incentive_id"];
        $incentiveInfo = $this->getFormIncentive($incentiveId);
        $html = view('template/AnnexToGDNT')->with("incentiveInfo", $incentiveInfo);
        $filename = "./upload/".$incentiveInfo["data"]["general"]["issue_from_date"]."_annex_GDNT.xls";
        file_put_contents($filename, $html);

        $info = array(
            "url" => "../../../upload/".$incentiveInfo["data"]["general"]["issue_from_date"]."_annex_GDNT.xls"
        );

        $data = array(
            "success" => true,
            "data" => $info
        );
        return $data;
    }

    public function convertSummaryIncomeOutcomeToExcel(Request $request){
        $input = $request->all();
        // dd($input);
        $year = $input["year"];
        $html = view('template/SummaryIncomeOutcome');
        $filename = "./upload/".$year."_summary_income_outcome.xls";
        file_put_contents($filename, $html);

        $info = array(
            "url" => "../../../upload/".$year."_summary_income_outcome.xls"
        );

        $data = array(
            "success" => true,
            "data" => $info
        );
        return $data;
    }

    public function getFormIncentive($id){
        $table = Incentive::find($id);
        $getIncentiveByBanks = Incentive::getIncentiveByBanks($id);
        $getIncentiveByEntities = Incentive::getIncentiveByEntities($id, 0);
        // dd($this->num2khtext("1273800000", true));
        // dd($getIncentiveByEntities);
        $incentiveByBanks = array();
        foreach($getIncentiveByBanks as $getIncentiveByBank){
            $incentiveByBanks[] = array(
                "no" => $this->convertToKhmerNumber2($getIncentiveByBank["no"]),
                "id" => $getIncentiveByBank["id"],
                "label" => $getIncentiveByBank["label"],
                "total_incentive" => $this->convertToKhmerNumber2(number_format($getIncentiveByBank["total_incentive"]), 0),
                "total_incentive_in_word" => $this->num2khtext($getIncentiveByBank["total_incentive"], true),
                "exchange_rate" => $this->convertToKhmerNumber2($getIncentiveByBank["exchange_rate"])
            );
        }

        $entityData = array();
        $total_officer_entity = 0;
        foreach($getIncentiveByEntities as $getIncentiveByEntity){
            $officerData = array();
            $total_officer_entity += count($getIncentiveByEntity["officers"]);
            foreach($getIncentiveByEntity["officers"] as $officer){
                $officerData[] = array(
                    "no" => $this->convertToKhmerNumber2($officer["no"]),
                    "identity_no" => $officer["identity_no"],
                    "first_name" => $officer["first_name"],
                    "last_name" => $officer["last_name"],
                    "bank" => $officer["bank"],
                    "bank_account_no" => $officer["bank_account_no"],
                    "latin" => $officer["latin"],
                    "position" => $officer["position"],
                    "duty" => $officer["duty"],
                    "index" => $officer["index"],
                    "incentive" => $this->convertToKhmerNumber2(number_format($officer["incentive"]), 0),
                    "total_incentive_with_reminder" => $this->convertToKhmerNumber2(number_format($officer["total_incentive_with_reminder"]), 0),
                    "tax" => $this->convertToKhmerNumber2(number_format($officer["tax"]), 0),
                    "return_amount" => $this->convertToKhmerNumber2(number_format($officer["return_amount"]), 0),
                    "reminder_amount" => $this->convertToKhmerNumber2(number_format($officer["reminder_amount"]), 0),
                    "incentive_after_tax" => $this->convertToKhmerNumber2(number_format($officer["incentive_after_tax"], 0)),
                );
            }
            $entityData[] = array(
                "no" => $this->convertToKhmerNumber2($getIncentiveByEntity["no"]),
                "id" => $getIncentiveByEntity["id"],
                "label" => $getIncentiveByEntity["label"],
                "code" => $getIncentiveByEntity["code"],
                "entity" => $getIncentiveByEntity["label"],
                "total_incentive" => $this->convertToKhmerNumber2(number_format(($getIncentiveByEntity["total_incentive"]), 0)),
                "total_incentive_with_reminder" => $this->convertToKhmerNumber2(number_format(($getIncentiveByEntity["total_incentive_with_reminder"]), 0)),
                "total_officer" => $this->convertToKhmerNumber2(number_format($getIncentiveByEntity["total_officer"], 0)),
                "officers" => $officerData
            );
        }

        $incentiveInfo = array(
            "id" => $table->id,
            "title" => $table->title,
            "khmer_date" => $table->khmer_date,
            "khmer_day" => $table->khmer_day,
            "khmer_year" => $this->convertToKhmerNumber2(date("Y", strtotime($table["issue_from_date"]))),
            //"khmer_day1" => $this->convertToKhmerDay(date("D", strtotime($table["issue_date"]))),
            "count_month" => CommonService::GetNumberOfMonth($table["issue_from_date"], $table["issue_to_date"]),
            "khmer_month" => $this->convertToKhmerMonth(date("m", strtotime($table["issue_from_date"]))),
            "khmer_from_month" => $this->convertToKhmerMonth(date("m", strtotime($table["issue_from_date"] . " +1 days"))),
            "khmer_to_month" => $this->convertToKhmerMonth(date("m", strtotime($table["issue_to_date"]))),
            "khmer_current_year" => $this->convertToKhmerNumber2(date("Y", strtotime($table["issue_date"]))),
            "khmer_current_day" => $this->convertToKhmerNumber2(date("d", strtotime($table["issue_date"]))),
            "khmer_current_date" => $this->convertToKhmerDay(date("D", strtotime($table["issue_date"]))),
            "khmer_current_month" => $this->convertToKhmerMonth(date("m", strtotime($table["issue_date"]))),

            "letter_type" => $table->letter_type,
            "sent_to" => $table->sent_to,
            "prepared_by" => $table->prepared_by,
            "seen_by" => $table->seen_by,
            "approved_by" => $table->approved_by,
            "reference" => $table->reference,
            "issue_date" => date("Y-m-d", strtotime($table->issue_date)),
            "issue_from_date" => date("Y-m-d", strtotime($table->issue_from_date)),
            "issue_to_date" => date("Y-m-d", strtotime($table->issue_to_date)),
            "issue_date_khmer" => date("Y-m-d", strtotime($table->issue_date)),
            "effective_date" => $table->effective_date,
            "attach_fille" => $table->attach_fille,
            "is_approve" => $table->is_approve,
            "total_incentive" => number_format($table->total_incentive),
            "total_incentive_in_khmer" => $this->convertToKhmerNumber2(number_format($table->total_incentive), 0),
            "total_incentive_in_word" => $this->num2khtext($table->total_incentive, true),
            
            "total_incentive_with_reminder_in_khmer" => $this->convertToKhmerNumber2(number_format(($table->total_reminder + $table->total_incentive)), 0),
            "total_incentive_with_reminder_in_word" => $this->num2khtext($table->total_reminder + $table->total_incentive, true),
            "total_return_amount_in_khmer" => $this->convertToKhmerNumber2(number_format($table->total_return_amount), 0),
            "total_incentive_after_tax_in_khmer" => $this->convertToKhmerNumber2(number_format($table->total_incentive_after_tax), 0),
            "total_reminder_amount_in_khmer" => $this->convertToKhmerNumber2(number_format($table->total_reminder), 0),

            "currency" => $table->currency,
            "total_tax" => $table->total_tax,
            "total_tax_in_khmer" => $this->convertToKhmerNumber2(number_format(($table->total_tax), 0)),
            "total_tax_in_word" => $this->num2khtext($table->total_tax, true),
            "total_entity" => $this->convertToKhmerNumber2($table->total_entity),
            "total_officer" => $this->convertToKhmerNumber2($total_officer_entity),
            "exchange_rate" => $table->exchange_rate,
            "remark" => $table->remark,
            "created_at" => $table->created_at,
            "updated_at" => $table->updated_at,
        );
        $dataArray = array(
            "general" => $incentiveInfo,
            "total_bank" => $this->convertToKhmerNumber2(count($incentiveByBanks) + 1),
            "incentiveByBanks" => $incentiveByBanks,
            "incentiveByEntities" => $entityData,
        );
        $data = array(
            "data" => $dataArray
        );
        return $data;
    }

    public function convertToKhmerNumber2($number){
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

    public function convertToKhmerMonth($monthNumber) {
        $month = [
           '01' => 'មករា',
           '02' => 'កុម្ភះ',
           '03' => 'មីនា',
           '04' => 'មេសា',
           '05' => 'ឧសភា',
           '06' => 'មិថុនា',
           '07' => 'កក្កដា',
           '08' => 'សីហា',
           '09' => 'កញ្ញា',
           '10' => 'តុលា',
           '11' => 'វិច្ឆិកា',
           '12' => 'ធ្នូ',
        ];
        return $month[$monthNumber];
    }

    public function convertToKhmerDay($str) {
        $day = [
           'Sun' => 'អាទិត្យ',
           'Mon' => 'ច័ន្ទ',
           'Tue' => 'អង្គារ',
           'Wed' => 'ពុធ',
           'Thu' => 'ព្រហស្បត្តិ៍',
           'Fri' => 'សុក្រ',
           'Sat' => 'សៅរ៍'
        ];
        return $day[$str];
    }

    public function num2khtext($complete_char,$enableThousand){
        //function for split uft8 character
        // function mb_str_split( $string ) { 
        //     //Split at all position not after the start: ^ 
        //     //and not before the end: $ 
        //     return preg_split('/(?<!^)(?!$)/u', $string ); 
        // }		
        //remove left zeros
        $cleanStr = ltrim($complete_char, '0');	
        //split number/string to array
        $num_arr = mb_str_split($cleanStr);	
        $translated=''; $addThousand=false;
        //string array
        $khNUMTxt = array('','មួយ','ពីរ','បី','បួន','ប្រាំ');
        $twoLetter = array('','ដប់','ម្ភៃ','សាមសិប','សែសិប','ហាសិប','ហុកសិប','ចិតសិប','ប៉ែតសិប','កៅសិប');
        $khNUMLev = array('','','','រយ','ពាន់','មឿន','សែន','លាន');
        $khnum = array('០','១','២','៣','៤','៥','៦','៧','៨','៩');
        //loop to check each number character
        foreach($num_arr as $key=>$value){
        //convert khmer number to latin number if found
        if(in_array($value,$khnum)){$value = array_search($value,$khnum);}
        //allow only number
        if(!is_numeric($value)){return '';}
        //check what pos the charactor in
        $pos = count($num_arr) - ($key);
        if($pos>count($khNUMLev)-1){$pos=($pos % count($khNUMLev))+2;}
        //enable or diable read in thousand
        if($enableThousand and ($pos == 5 or $pos == 6)){$pos = $pos-3;}
        //concatenate number as text
        if($pos==2){
        $translated .= $twoLetter[$value];
        }else{
        if($value>5){$translated .=  $khNUMTxt[5].$khNUMTxt[$value - 5];}else{$translated .= $khNUMTxt[$value];}
        }
        //work for thousand
        if($pos==2 or $pos == 3 or $pos == 4){
        if($value>0){$addThousand=true;}
        }
        //concatenate number level
        if($value>0 or ($pos==4 and $addThousand and $enableThousand) or $pos==7){
        $translated .= $khNUMLev[$pos];			
        }
        //make addthousand to default value (false)
        if($pos==4){$addThousand=false;}		
        }
        //return the complete number in text
        return $translated;
    }
}
