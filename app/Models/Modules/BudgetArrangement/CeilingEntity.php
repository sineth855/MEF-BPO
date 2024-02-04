<?php

namespace App\Models\Modules\BudgetArrangement;

use Illuminate\Database\Eloquent\Model;
use DB;

class CeilingEntity extends Model
{
    protected $table = 'mef_ceiling_entity';
    protected $fillable = [
                            'planing_id',
                            'ceiling_exp_group',
                            // 'ceiling_exp_type',
                            'sub_program_id',
                            'entity_id',
                            'entity_parent_id',
                            'ceiling_rule',
                            'reg_expense',
                            'non_reg_expense',
                            'ceiling_tran_year_0',
                            'ceiling_tran_year_1',
                            'ceiling_tran_year_2',
                            'ceiling_tran_year_3',
                            'increase_rate_year_0',
                            'increase_rate_year_1',
                            'increase_rate_year_2',
                            'increase_rate_year_3',
                            'remark',
                            'created_by',
                            'modified_by'
                          ];
    public $timestamps = true;

    public static function getCeilingEntities(){
      $ceilingGroupDataArr = array();
      $ceilingGroups = DB::table("mef_ceiling_exp_group")->orderBy("order_level")->get();
      foreach($ceilingGroups as $ceilingGroup){
        $ceilingEntityArr = array();
        $ceilingGroupId = $ceilingGroup->id;
        $ceilingEntities = DB::table("mef_ceiling_entity as ce")
                          ->select("e.*")
                          ->join("entity as e", "e.id", "ce.entity_id")
                          ->whereNull("entity_parent_id")
                          ->where("ceiling_exp_group", $ceilingGroupId)
                          ->get();
        foreach($ceilingEntities as $ceilingEntity){
          $ceilingEntityId = $ceilingEntity->id;
          $ceilingEntityDataArr = array();

          $ceilingEntityDatas = DB::table("mef_ceiling_data as cd")
                              ->select("cd.*", "et.name_en","et.name_kh")
                              ->join("mef_ceiling_exp_type as et", "et.id", "cd.ceiling_exp_type")
                              ->orderBy("et.order_level")
                              ->where("cd.ceiling_entity_id", $ceilingEntityId)
                              ->get();
          foreach($ceilingEntityDatas as $ceilingEntityData){
            $ceilingEntityDataArr[] = array(
              "name_en" => $ceilingEntityData->name_en,
              "name_kh" => $ceilingEntityData->name_kh,
              'ceiling_entity_id' => $ceilingEntityData->ceiling_entity_id,
              'ceiling_exp_group' => $ceilingEntityData->ceiling_exp_group,
              'ceiling_exp_type' => $ceilingEntityData->ceiling_exp_type,
              'ceiling_rule' => $ceilingEntityData->ceiling_rule,
              'ceiling_rule' => $ceilingEntityData->ceiling_rule,
              'reg_expense' => $ceilingEntityData->reg_expense,
              'non_reg_expense' => $ceilingEntityData->non_reg_expense,
              'ceiling_tran_year_0' => $ceilingEntityData->ceiling_tran_year_0,
              'ceiling_tran_year_1' => $ceilingEntityData->ceiling_tran_year_1,
              'ceiling_tran_year_2' => $ceilingEntityData->ceiling_tran_year_2,
              'ceiling_tran_year_3' => $ceilingEntityData->ceiling_tran_year_3,
              'increase_rate_year_0' => $ceilingEntityData->increase_rate_year_0,
              'increase_rate_year_1' => $ceilingEntityData->increase_rate_year_1,
              'increase_rate_year_2' => $ceilingEntityData->increase_rate_year_2,
              'increase_rate_year_3' => $ceilingEntityData->increase_rate_year_3,
              'remark' => $ceilingEntityData->remark,
            );
          }

          $ceilingEntityArr[] = array(
            'code'=> $ceilingEntity->code,
            'department_id'=> $ceilingEntity->department_id,
            "name_en"=> $ceilingEntity->name_en,
            "name_kh"=> $ceilingEntity->name_kh,
            'color'=> $ceilingEntity->color,
            'limit_member'=> $ceilingEntity->limit_member,
            "order_level"=> $ceilingEntity->order_level,
            'abbreviation'=> $ceilingEntity->abbreviation,
            'deputy_commissionerofficer'=> $ceilingEntity->deputy_commissionerofficer,
            'professional_offier'=> $ceilingEntity->professional_offier,
            'ceiling_data' => $ceilingEntityDataArr
          );
        }

          $ceilingGroupDataArr[] = array(
            "id" => $ceilingGroup->id,
            "name" => $ceilingGroup->name_kh,
            "name_en" => $ceilingGroup->name_en,
            "name_kh" => $ceilingGroup->name_kh,
            "remark" => $ceilingGroup->remark,
            "status" => $ceilingGroup->status,
            "hasColspan" => true,
            "colspan" => 12,
            "order_level" => "",
            "data"=> array(
              "summary" => array(
                "id" => 1,
                "name" => "សរុបរួមក្រសួង",
                "values" => array(1.00, 2.00, 3.00, 4.00, 5.00, 6.00, 7.00, 8.00, 9.00, "")
              ),
              "children" => array(
                [
                  "id" => 1,
                  "name" => "I.រដ្ឋបាលកណ្តាល",
                  "values" => [0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, ""],
                    "data" => array(
                      [
                        "id" => 1,
                      "name" => "- បន្ទុកបុគ្គលិក",
                      "values" => [0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, ""],
                      ],
                      [
                        "id" => 1,
                      "name" => "- ក្រៅបន្ទុកបុគ្គលិក",
                      "values" => [0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, ""],
                      ],
                    ),
                    // $ceilingEntityArr
                  
                  "dataDetails" => array(
                    [
                      "id" => 1,
                      "name" => "១. អនុកម្មវិធីទី១.១ អគ្គនាយកដ្ឋាន​គោលនយោបាយ",
                      "entity" => array(),
                      "values" => [0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, ""],
                      "data" => array(
                        [
                          "id" => 1,
                        "name" => "- បន្ទុកបុគ្គលិក",
                        "values" => [0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, ""],
                        ],
                        [
                          "id" => 1,
                        "name" => "- ក្រៅបន្ទុកបុគ្គលិក",
                        "values" => [0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, ""],
                        ]
                        ),
                      "ceiling_entities" => array(
                        [
                          "id" => 1,
                        "name" => "- បន្ទុកបុគ្គលិក",
                        "values" => [0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, ""],
                        ],
                        [
                          "id" => 1,
                        "name" => "- បន្ទុកបុគ្គលិក",
                        "values" => [0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, ""],
                        ],
                      ),
                    ]
                  )
                  ]
              )
          )
        );
      }
      return $ceilingGroupDataArr;
    }
}
