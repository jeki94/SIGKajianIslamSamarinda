<?php 
// push notif mobile
	function send_notificationMobile ($tokens, $message)
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
	

	$conn = mysqli_connect("localhost","root","","map_bencana_v2.1");

	$sql = " Select Token From user";

	$result = mysqli_query($conn,$sql);
	$tokens = array();

	if(mysqli_num_rows($result) > 0 ){

		while ($row = mysqli_fetch_assoc($result)) {
			$tokens[] = $row["Token"];
		}
	}

	mysqli_close($conn);

	$message = array("message" => " Info Bencana Terbaru");
	$message_status = send_notificationMobile($tokens, $message);
	// echo $message_status;
	// echo "konek";
	echo "Berhasil Menambah";

 ?>
