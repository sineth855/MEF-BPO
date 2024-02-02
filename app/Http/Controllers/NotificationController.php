<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\NotificationUser;
use App\Models\Mobile\UserDevice;
use Auth;
use DateTime;
use PushNotificationService;
class NotificationController extends Controller
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
        $userId = Auth::user()->id;
        $table = Notification::getNotificationByUsers($userId, $filter);
        $data = array(
            "data" => $table,
            "total" => count($table)
        );
        return response()->json($data);
    }

    public function sendNotification(Request $request){
        $sendPushNotification = PushNotificationService::sentNotificationToUserDevice($request);
        $data = array();
        if($sendPushNotification){
            $queryUserDevices = UserDevice::GroupBy("user_id")->get();
            foreach($queryUserDevices as $userDevice){
                NotificationUser::create([
                    "user_id" => $userDevice->user_id,
                    "officer_id" => "",
                    "title" => $request["title"],
                    "description" => $request["body"],
                    "status" => 1,
                    "push_count" => 1,
                    "notification_type" => $request["notification_type"],
                    "created_at" => date("Y-m-d H:i:s")
                ]);
            }
            $data = array(
                "success" => true,
                "message" => "Notification has been sent."
            );
        }else{
            $data = array(
                "success" => false,
                "message" => "Fail to send notification!"
            );
        }
        return response()->json($data);
    }
   
}
