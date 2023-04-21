<?php

namespace App\Models\Modules\BudgetArrangement;

use Illuminate\Database\Eloquent\Model;
use App\Models\Modules\ProgramManagement\Program;
use App\Models\Modules\ProgramManagement\SubProgram;
use App\Models\Modules\ProgramManagement\ClusterActivity;
use DB;

class PIPInvestment extends Model
{
    protected $table = 'mef_pip_investment';
    protected $fillable = [
                            'entity_id',
                            'planning_id',
                            'sub_program_id',
                            'cluster_activity_id',
                            'pip_no',
                            'project_status',
                            'project_type',
                            'project_name_en',
                            'project_name_kh',
                            'currency_exchange_id',
                            'exchange_rate',
                            'column_type',
                            'finance_resource_id',
                            'status',
                            'est_costing_year_0',
                            'est_costing_year_1',
                            'est_costing_year_2',
                            's_fin_year_0',
                            's_fin_year_1',
                            's_fin_year_2',
                            'grading_no',
                            'created_by',
                            'modified_by'
                        ];
    public $timestamps = true;

    public function SubProgram(){
      return $this->belongsTo(SubProgram::class,'sub_program_id');
    }

    public static function getPIPInvestment(){
        $programs = Program::orderBy("order_level", "ASC")->get();
        $data = array();
        foreach($programs as $program){
            $programId = $program->id;
            $subPrograms = SubProgram::orderBy("order_level", "ASC")->where("program_id", $programId)->get();
            $subProgs = array();
            foreach($subPrograms as $subProgram){
                $subProgramId = $subProgram->id;
                $pipInvestments = PIPInvestment::where("sub_program_id", $subProgramId)->where("planning_id", PLANNING_YEAR)->orderBy("order_level")->get();
                $pipInvPros = array();
                foreach($pipInvestments as $pipInvestment){
                    $pipInvestmentId = $pipInvestment->id;
                    $pipInvProDetails = DB::table("mef_pip_inv_detail")->where("pip_inv_id", $pipInvestmentId)->get();
                    $pipInvestmentData = array();
                    foreach($pipInvProDetails as $pipInvProDetail){
                        $pipInvestmentData[] = array(
                            ""
                        );
                    }

                    $pipInvPros[] = array(
                        "pip_no" => $pipInvestment->pip_no,
                        "project_status" => $pipInvestment->project_status,
                        "project_type" => $pipInvestment->project_type,
                        "project_name_en" => $pipInvestment->project_name_en,
                        "project_name_kh" => $pipInvestment->project_name_kh,
                        "exchange_rate" => $pipInvestment->exchange_rate,
                        "finance_resource_id" => $pipInvestment->finance_resource_id,
                        "status" => $pipInvestment->status,
                        "est_costing_year_0" => $pipInvestment->est_costing_year_0,
                        "est_costing_year_1" => $pipInvestment->est_costing_year_1,
                        "est_costing_year_2" => $pipInvestment->est_costing_year_2,
                        "s_fin_year_0" => $pipInvestment->s_fin_year_0,
                        "s_fin_year_1" => $pipInvestment->s_fin_year_1,
                        "s_fin_year_2" => $pipInvestment->s_fin_year_2,
                        "grading_no" => $pipInvestment->grading_no,
                        "order_level" => $pipInvestment->order_level,
                        "created_by" => $pipInvestment->created_by,
                        "modified_by" => $pipInvestment->modified_by,
                        "created_at" => $pipInvestment->created_at,
                        "updated_at" => $pipInvestment->updated_at
                    );
                } 
                $subProgs[] = array(
                    "id" => $subProgram->id,
                    "code" => $subProgram->code,
                    "sub_code" => $subProgram->sub_code,
                    "name_kh" => $subProgram->name_kh,
                    "name_en" => $subProgram->name_en,
                    "order_level" => $subProgram->order_level,
                    "created_by" => $subProgram->created_by,
                    "pipInvPros" => $pipInvPros
                );
            }
            $data[] = array(
                "id" => $program->id,
                "code" => $program->code,
                "sub_code" => $program->sub_code,
                "name_kh" => $program->name_kh,
                "name_en" => $program->name_en,
                "order_level" => $program->order_level,
                "created_by" => $program->created_by,
                "sub_programs" => $subProgs
            );
        }

        return $data;
    }
}