<?php
	
include("../../settings/koneksi.php");

class bencana{}
 $response = array();
 if($_SERVER['REQUEST_METHOD']=='POST'){
 	//Mendapatkan Nilai Variable
 		$server = $server;
		$nama = $_POST['nama'];
		$latitude = $_POST['latitude'];
		$longtitude = $_POST['longtitude'];
		date_default_timezone_set("Asia/Singapore");
		$date = date('Y-m-d H:i:s');
		$lokasi = $_POST['lokasi'];
		$korban = $_POST['korban'];
		$kerugian = $_POST['kerugian'];
		$penyebab = $_POST['penyebab'];
		$gambar = $_POST['gambar'];
		$ket = $_POST['ket'];
		$username =$_POST['username'];
		// $gambar = $_POST['gambar'];
		// decode gambar 
		define('UPLOAD_DIR', '../../image/bencana/');
		$gambar = $_POST['gambar'];
	    $gambar = str_replace('data:image/JPEG;base64,', '', $gambar);
	    $gambar = str_replace(' ', '+', $gambar);
	    $data = base64_decode($gambar);
	    $gambarNama = 'IMG_'.uniqid() . '.png';
	    $file = UPLOAD_DIR . $gambarNama;
	    $success = file_put_contents($file, $data);
	    $finalImage = $server.$imageBencana.$gambarNama;
		// end decode gambar

		if("" == trim($_POST['korban'])){$korban = $default;} 
		if("" == trim($_POST['gambar'])){$gambar = $default;} 
		if("" == trim($_POST['kerugian'])){$kerugian = $default;} 
		if("" == trim($_POST['penyebab'])){$penyebab = $default;} 

		$sql = "INSERT INTO bencana (nama_bencana, lat, lng, status, tgl, lokasi, korban, kerugian, penyebab, keterangan, gambar) VALUES ('$nama','$latitude','$longtitude', '$aktif', '$date', '$lokasi', '$korban', '$kerugian', '$penyebab', '$ket', '$finalImage');";
		$sql .= "UPDATE bencana SET id_user = (SELECT id_user FROM user WHERE username='$username') WHERE bencana.id_bencana=LAST_INSERT_ID()";

		$result = mysqli_multi_query($con,$sql);



		// ntar dulu

		if ($result) {
			//ntar dulu
			// require_once('/service/push_notification.php');
			// require_once('../../MapsBencanaWeb/service/PushNotification.php');

			require_once('../../MapsBencanaWeb/service/PushNotification.php');
			//
			$response["success"] = 1;
			$response["success"] = "Berhasil Menambah Bencana";

		// $response["success"] = $nama.$longtitude.$latitude.$date.$lokasi.$korban.$kerugian.$penyebab.$gambar.$ket.$username;

			echo json_encode($response);
		}else{
			$response["success"] = 0;
			$response["success"] = "Gagal Menambah Bencana";
			echo json_encode($response);
		}
	}

?>