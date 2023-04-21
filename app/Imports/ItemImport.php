<?php

namespace App\Imports;

use App\Models\Settings\Item;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use DB;
use Auth;
class ItemImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $queryCheck = Item::where("id", (int)$row["id"])->first();
        if(!$queryCheck){
            Item::insert([
                "id"=> $row["id"],
                "code"=>$row["code"],
                "title_en"=>$row["title_en"],
                "title_kh"=>$row["title_kh"],
                "order_level"=>$row["order_level"]
            ]);
        }
    }
}
