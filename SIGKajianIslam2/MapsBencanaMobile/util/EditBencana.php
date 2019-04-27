<?php
	
include("../../settings/koneksi.php");

class bencana{}
 $response = array();
 if($_SERVER['REQUEST_METHOD']=='POST'){
 	//Mendapatkan Nilai Variable
 		$server = $server;
 		$id = $_POST['id'];
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
    	// print $success ? $file : 'Unable to save the file.';
		// end decode gambar

		if("" == trim($_POST['korban'])){$korban = $default;} 
		if("" == trim($_POST['gambar'])){$gambar = $default;} 
		if("" == trim($_POST['kerugian'])){$kerugian = $default;} 
		if("" == trim($_POST['penyebab'])){$penyebab = $default;} 

		$sql = "UPDATE bencana SET 
		nama_bencana='$nama', 
		lat='$latitude', 
		lng='$longtitude', 
		lokasi='$lokasi', 
		korban='$korban', 
		kerugian='$kerugian', 
		penyebab='$penyebab', 
		keterangan='$ket', 
		gambar='$finalImage'
		WHERE bencana.id_bencana = '$id'";

		$result = mysqli_query($con,$sql);

		if ($result) {
			require_once('../push_notification.php');
			$response["success"] = 1;
			$response["success"] = "Berhasil";
			echo json_encode($response);
			// $response = new bencana();
			// $response->success = 1;
			// $response->message = "Successfully Uploaded";
			// die(json_encode($response));
		}else{
			// $response = new bencana();
			// $response->success = 0;
			// $response->message = "Error Upload image";
			// die(json_encode($response)); 
			$response["success"] = 0;
			$response["success"] = "netnot";
			echo json_encode($response);
		}
	}

?>