<?php 
//push notif web
	include('../../settings/koneksi.php') ;
	include("PushNotificationWeb.php");
	function send_notificationWeb ($tokens, $message)
	{
		$url = 'https://fcm.googleapis.com/fcm/send';
		$fields = array(
			 'registration_ids' => $tokens,
			 'data' => $message
			);

		$headers = array(
			'Authorization:key = AAAArNm42Hw:APA91bEC9uiBojRGhSGdmQkwIrTlr0zGasm__Uy0tnc8nZp0E8toxcl1xnB2Yac0OFTIPD8YeXiWS_1z85t345VgXXKtVUbw0HUZGyET84RixFdCIkHSX5PdURAPgKiDgWnV8aYsSf92 ',
			'Content-Type: application/json'
			);

	   $ch = curl_init();
       curl_setopt($ch, CURLOPT_URL, $url);
       curl_setopt($ch, CURLOPT_POST, true);
       curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);  
       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
       curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
       $result = curl_exec($ch);           
       if ($result === FALSE) {
           die('Curl failed: ' . curl_error($ch));
       }
       curl_close($ch);
       return $result;
	}
	
	$sql = " Select Token From user";
	$bencana = mysqli_query($con, "SELECT * FROM bencana ORDER BY id_bencana DESC LIMIT 1");
	$hasil = mysqli_fetch_array($bencana);
	$bencana = $hasil['nama_bencana'];


	$result = mysqli_query($con,$sql);
	$tokens = array();

	if(mysqli_num_rows($result) > 0 ){

		while ($row = mysqli_fetch_assoc($result)) {
			$tokens[] = $row["Token"];
		}
	}

	mysqli_close($con);

	// sampe sini
	$message = array("message" => " INFO BENCANA ".strtoupper($bencana). " TERBARU");
	$message_status = send_notificationWeb($tokens, $message);

	header("location:/SIGKajianIslam/WebKajianIslam/newdashboard.php");
	// require '../../MapsbencanaMobile/push_notification.php';
	require 'PushNotificationMobile.php';




 ?>
