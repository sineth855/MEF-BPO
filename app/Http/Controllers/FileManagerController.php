<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incentive;
use App\Models\FileManager;

use App\Imports\ObjectiveImport;
use App\Imports\ProgramImport;
use App\Imports\SubProgramImport;
use App\Imports\ClusterActivityImport;

use App\Imports\AccountGroupImport;
use App\Imports\AccountImport;

use App\Imports\CeilingEntityImport;
use App\Imports\CeilingDataEntityImport;

use App\Imports\PIPInvestmentImport;
use App\Imports\PIPInvDetailImport;

use App\Imports\BSPAssignProgramImport;

use App\Imports\ItemImport;
use App\Imports\UnitImport;


use App\Imports\CsvImport;
use App\Imports\OfficerImport;
use App\Imports\OfficerExpenseIncentiveImport;
use App\Imports\IncomeImport;
use App\Imports\OutcomeImport;
use App\Imports\EntityImport;
use App\Imports\EntityMemberImport;
use Auth;
// use Excel;
use Maatwebsite\Excel\Facades\Excel;
use File;
use Input;
class FileManagerController extends Controller
{
    /**
     * Display a listing of the BestSeller Create On 01-02-2018
     *
     * @return \Illuminate\Http\Response
     */
    
    public function fileUploadService(Request $request){
        $path = $request->file('file')->getRealPath();
        $rows = Excel::import(new OfficerImport, $path);
        if($rows){
            return response()->json(['success'=>true,'message'=>'File uploaded successfully.'], 200);
        }else{
            return response()->json(['success'=>false,'message'=>'File upload is failed!'], 500);
        }
        // $dd = Excel::selectSheets('sheet1')->load();
        // $array = (new CsvImport)->import($path);
        // $result = Excel::import($path,function($reader){
        //     $reader->all();
        // })->get();
        // print_r($rows);
        // $input = $request->all();
        // // $file = $request->file('file');
        // $file = $input['file'];
        // $date_create = date('d-M-Y/');
        // $destinationPath = 'images/uploads/'.$date_create; // upload path
        // $extension = $request->file('file')->getClientOriginalExtension(); // getting image extension
        // // $fileName = $this->generateRandomString(10).'.'.$extension; // renameing image
        // // $fileName = rand(11111111,99999999).'.'.$extension; // renameing image
        // $fileName = $file->getClientOriginalName();
        // $request->file('file')->move($destinationPath, $fileName); 
        // $fileUrl = '/'.$destinationPath.$fileName;
        // $path = $request->file('file')->getRealPath();
        // $result = Excel::import($file,function($reader){
        //     $reader->all();
        // })->get();
        // if($request->hasFile('file')){
        //     // $path = $request->file('file')->getRealPath();
        //     // $reader = Excel::import('./images/uploads/28-Jun-2020/Book1.xlsx');
        //     // $data = Excel::import($path, null, \Maatwebsite\Excel\Excel::XLSX);
        //     // print_r($datas);
        //     // $file = $request->file('file');
        //     // $fileName = $file->getClientOriginalName();
        //     $path = "./images/uploads/28-Jun-2020/Book1.xlsx";
		// 	$data = Excel::import($path, function($reader) {})->get();
		// 	if(!empty($data) && $data->count()){
		// 		foreach ($data->toArray() as $key => $value) {
		// 			if(!empty($value)){
		// 				foreach ($value as $v) {		
		// 					$insert[] = ['title' => $v['title'], 'description' => $v['description']];
		// 				}
		// 			}
		// 		}
		// 		prin_r($insert);
		// 		if(!empty($insert)){
		// 			// Item::insert($insert);
		// 			return back()->with('success','Insert Record successfully.');
		// 		}
		// 	}
		// }
		// return back()->with('error','Please Check your file, Something is wrong there.');
        // $input = $request->all();
        // $path = $request->file('file');//$request->file('import_file')->getRealPath();
        // $data = Excel::load($path, function($reader) {})->get();
        // print_r($data);
        // return false;
        // $attachments_files = $request->file('file');
        // $file = $input['file'];
        // $date_create = date('d-M-Y/');
        // $destinationPath = 'images/uploads/'.$date_create; // upload path
        // $extension = $request->file('file')->getClientOriginalExtension(); // getting image extension
        // // $fileName = $this->generateRandomString(10).'.'.$extension; // renameing image
        // // $fileName = rand(11111111,99999999).'.'.$extension; // renameing image
        // $fileName = $file->getClientOriginalName();
        // $request->file('file')->move($destinationPath, $fileName); 
        // $fileUrl = '/'.$destinationPath.$fileName;
        // $createImage = FileManager::create([
        //     "file_name" => $fileName,
        //     "url" => $fileUrl,
        //     "file_type" => $file->getClientOriginalExtension(),
        //     "extention" => $file->getClientOriginalExtension()
        // ]);
        // $fileUrl = '/'.$destinationPath.$fileName;
        // return response()->json(['success'=>true,'message'=>'File uploaded successfully.','data'=>['file_url'=>$fileUrl,'extension'=>$extension]], 200);
    }
    
    public function fileUploadObjective(Request $request){
        $path = $request->file('file')->getRealPath();
        $rows = Excel::import(new ObjectiveImport, $path);
        if($rows){
            return response()->json(['success'=>true,'message'=>'File uploaded successfully.'], 200);
        }else{
            return response()->json(['success'=>false,'message'=>'File upload is failed!'], 500);
        }
    }
    public function fileUploadProgram(Request $request){
        $path = $request->file('file')->getRealPath();
        $rows = Excel::import(new ProgramImport, $path);
        if($rows){
            return response()->json(['success'=>true,'message'=>'File uploaded successfully.'], 200);
        }else{
            return response()->json(['success'=>false,'message'=>'File upload is failed!'], 500);
        }
    }
    public function fileUploadSubProgram(Request $request){
        $path = $request->file('file')->getRealPath();
        $rows = Excel::import(new SubProgramImport, $path);
        if($rows){
            return response()->json(['success'=>true,'message'=>'File uploaded successfully.'], 200);
        }else{
            return response()->json(['success'=>false,'message'=>'File upload is failed!'], 500);
        }
    }
    public function fileUploadClusterActivity(Request $request){
        $path = $request->file('file')->getRealPath();
        $rows = Excel::import(new ClusterActivityImport, $path);
        if($rows){
            return response()->json(['success'=>true,'message'=>'File uploaded successfully.'], 200);
        }else{
            return response()->json(['success'=>false,'message'=>'File upload is failed!'], 500);
        }
    }

    public function fileUploadAccountGroup(Request $request){
        $path = $request->file('file')->getRealPath();
        $rows = Excel::import(new AccountGroupImport, $path);
        if($rows){
            return response()->json(['success'=>true,'message'=>'File uploaded successfully.'], 200);
        }else{
            return response()->json(['success'=>false,'message'=>'File upload is failed!'], 500);
        }
    }
    public function fileUploadAccount(Request $request){
        $path = $request->file('file')->getRealPath();
        $rows = Excel::import(new AccountImport, $path);
        if($rows){
            return response()->json(['success'=>true,'message'=>'File uploaded successfully.'], 200);
        }else{
            return response()->json(['success'=>false,'message'=>'File upload is failed!'], 500);
        }
    }
    public function fileUploadSubAccount(Request $request){
        $path = $request->file('file')->getRealPath();
        $rows = Excel::import(new AccountImport, $path);
        if($rows){
            return response()->json(['success'=>true,'message'=>'File uploaded successfully.'], 200);
        }else{
            return response()->json(['success'=>false,'message'=>'File upload is failed!'], 500);
        }
    }

    public function fileUploadEntity(Request $request){
        $path = $request->file('file')->getRealPath();
        $rows = Excel::import(new EntityImport, $path);
        if($rows){
            return response()->json(['success'=>true,'message'=>'File uploaded successfully.'], 200);
        }else{
            return response()->json(['success'=>false,'message'=>'File upload is failed!'], 500);
        }
    }

    public function fileUploadEntityMember(Request $request){
        $path = $request->file('file')->getRealPath();
        $rows = Excel::import(new EntityMemberImport, $path);
        if($rows){
            return response()->json(['success'=>true,'message'=>'File uploaded successfully.'], 200);
        }else{
            return response()->json(['success'=>false,'message'=>'File upload is failed!'], 500);
        }
    }

    public function fileUploadCeilingEntity(Request $request){
        $path = $request->file('file')->getRealPath();
        $rows = Excel::import(new CeilingEntityImport, $path);
        if($rows){
            return response()->json(['success'=>true,'message'=>'File uploaded successfully.'], 200);
        }else{
            return response()->json(['success'=>false,'message'=>'File upload is failed!'], 500);
        }
    }

    public function fileUploadCeilingDataEntity(Request $request){
        $path = $request->file('file')->getRealPath();
        $rows = Excel::import(new CeilingDataEntityImport, $path);
        if($rows){
            return response()->json(['success'=>true,'message'=>'File uploaded successfully.'], 200);
        }else{
            return response()->json(['success'=>false,'message'=>'File upload is failed!'], 500);
        }
    }

    public function fileUploadPIPInvestment(Request $request){
        $path = $request->file('file')->getRealPath();
        $rows = Excel::import(new PIPInvestmentImport, $path);
        if($rows){
            return response()->json(['success'=>true,'message'=>'File uploaded successfully.'], 200);
        }else{
            return response()->json(['success'=>false,'message'=>'File upload is failed!'], 500);
        }
    }

    public function fileUploadPIPInvDetail(Request $request){
        $path = $request->file('file')->getRealPath();
        $rows = Excel::import(new PIPInvDetailImport, $path);
        if($rows){
            return response()->json(['success'=>true,'message'=>'File uploaded successfully.'], 200);
        }else{
            return response()->json(['success'=>false,'message'=>'File upload is failed!'], 500);
        }
    }

    public function fileUploadBSPAssignProgram(Request $request){
        // dd($request->all());
        $path = $request->file('file')->getRealPath();
        $rows = Excel::import(new BSPAssignProgramImport, $path);
        if($rows){
            return response()->json(['success'=>true,'message'=>'File uploaded successfully.'], 200);
        }else{
            return response()->json(['success'=>false,'message'=>'File upload is failed!'], 500);
        }
    }

    // 
    public function fileUploadOfficer(Request $request){
        $path = $request->file('file')->getRealPath();
        $rows = Excel::import(new OfficerImport, $path);
        if($rows){
            return response()->json(['success'=>true,'message'=>'File uploaded successfully.'], 200);
        }else{
            return response()->json(['success'=>false,'message'=>'File upload is failed!'], 500);
        }
    }

    public function OfficerIncentiveExpenseImport(Request $request){
        $path = $request->file('file')->getRealPath();
        $rows = Excel::import(new OfficerExpenseIncentiveImport, $path);
        if($rows){
            return response()->json(['success'=>true,'message'=>'File uploaded successfully.'], 200);
        }else{
            return response()->json(['success'=>false,'message'=>'File upload is failed!'], 500);
        }
    }

    public function fileIncomeUploadService(Request $request){
        $data = $request->all();
        $path = $request->file('file')->getRealPath();
        $rows = Excel::import(new IncomeImport, $path);
        if($rows){
            return response()->json(['success'=>true,'message'=>'File uploaded successfully.'], 200);
        }else{
            return response()->json(['success'=>false,'message'=>'File upload is failed!'], 500);
        }
    }

    public function fileOutcomeUploadService(Request $request){
        $path = $request->file('file')->getRealPath();
        $rows = Excel::import(new OutcomeImport, $path);
        if($rows){
            return response()->json(['success'=>true,'message'=>'File uploaded successfully.'], 200);
        }else{
            return response()->json(['success'=>false,'message'=>'File upload is failed!'], 500);
        }
    }

    public function fileUploadItem(Request $request){
        $path = $request->file('file')->getRealPath();
        $rows = Excel::import(new ItemImport, $path);
        if($rows){
            return response()->json(['success'=>true,'message'=>'File uploaded successfully.'], 200);
        }else{
            return response()->json(['success'=>false,'message'=>'File upload is failed!'], 500);
        }
    }

    public function fileUploadUnit(Request $request){
        $path = $request->file('file')->getRealPath();
        $rows = Excel::import(new UnitImport, $path);
        if($rows){
            return response()->json(['success'=>true,'message'=>'File uploaded successfully.'], 200);
        }else{
            return response()->json(['success'=>false,'message'=>'File upload is failed!'], 500);
        }
    }

    public function fileImageUploadService(Request $request){
        $input = $request->all();
        $attachments_files = $request->file('image');
        $image = $input['image'];
        $date_create = date('d-M-Y/');
        $destinationPath = 'images/uploads/'.$date_create; // upload path
        $extension = $request->file('image')->getClientOriginalExtension(); // getting image extension
        // $fileName = $this->generateRandomString(10).'.'.$extension; // renameing image
        // $fileName = rand(11111111,99999999).'.'.$extension; // renameing image
        $fileName = $image->getClientOriginalName();
        $request->file('image')->move($destinationPath, $fileName); // uploading file to given path
        // $imageUrl = config_url.'/'.$destinationPath.$fileName;
        $imageUrl = '/'.$destinationPath.$fileName;
        $createImage = FileManager::create([
            "file_name" => $fileName,
            "url" => $imageUrl,
            "file_type" => $image->getClientOriginalExtension(),
            "extention" => $image->getClientOriginalExtension()
        ]);
        $imageUrl = '/'.$destinationPath.$fileName;
        return response()->json(['success'=>true,'message'=>'File uploaded successfully.','data'=>['image_url'=>$imageUrl,'extension'=>$extension]], 200);
    }

    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
