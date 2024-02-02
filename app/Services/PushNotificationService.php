<?php 	
	
	namespace App\Services;
	use App\Models\Mobile\UserDevice;
	use App\Models\Mobile\OTP;
	use Carbon\Carbon;
	use DB;
	use Validator;
	use Auth;
	use Session;
	class PushNotificationService{
		
		public static function sentNotificationToUserDevice($request){
			$userDevices = UserDevice::whereNotNull('device_token')->pluck('device_token')->all();
			$firebaseDeviceToken = $userDevices;
			$SERVER_API_KEY = config_FIRE_BASE_SERVER_API_KEY;
			$data = [
				"registration_ids" => $firebaseDeviceToken,
				"notification" => [
					"title" => $request->title,
					"body" => $request->body,
					"notification_type" => $request->notification_type,
				]
			];

			$dataString = json_encode($data);
	
			$headers = [
				'Authorization: key=' . $SERVER_API_KEY,
				'Content-Type: application/json',
			];
	
			$ch = curl_init();
	
			curl_setopt($ch, CURLOPT_URL, config_FIRE_BASE_SERVER_URL);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
				
			$response = curl_exec($ch);
			return $response;
		}
	
	}
?>