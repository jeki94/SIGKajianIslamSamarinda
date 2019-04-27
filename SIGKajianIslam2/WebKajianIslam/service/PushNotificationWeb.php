<?php 
	include('../settings/koneksi.php') ;


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
	
	$header = [
		'Authorization: Key=' . SERVER_API_KEY,
		'Content-Type: Application/json'
	];
	$msg = [
		'title' => 'Info Bencana Terbaru',
		'body' => 'Buka Untuk Melihat',
		'icon' => 'img/maps_bencana.png',
		// 'image' => 'img/d.png',
	];
	$payload = [
		'registration_ids' 	=> $tokens,
		'data'				=> $msg
	];
	$curl = curl_init();
	curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => json_encode( $payload ),
	  CURLOPT_HTTPHEADER => $header
	));
	$response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);

	if ($err) {
	  echo "cURL Error #:" . $err;
	} else {
	  echo $response;
	}
 ?>