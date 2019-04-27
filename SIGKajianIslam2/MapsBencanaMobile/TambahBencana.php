<?php
	
include("Koneksi.php");

class bencana{}
 $response = array();
 if($_SERVER['REQUEST_METHOD']=='POST'){
 	//Mendapatkan Nilai Variable
		$nama = $_POST['nama'];
		$latitude = $_POST['latitude'];
		$longtitude = $_POST['longtitude'];
		date_default_timezone_set("Asia/Singapore");
		$date = date('Y-m-d H:i:s');
		$lokasi = $_POST['lokasi'];
		$korban = $_POST['korban'];
		$kerugian = $_POST['kerugian'];
		$penyebab = $_POST['penyebab'];
		$ket = $_POST['ket'];
		$gambar = $_POST['gambar'];

		if("" == trim($_POST['korban'])){$korban = $default;} 
		if("" == trim($_POST['kerugian'])){$kerugian = $default;} 
		if("" == trim($_POST['penyebab'])){$penyebab = $default;} 

		$random = random_word(20);
		
		$path = "images/bencana/".$random.".png";
		
		// sesuiakan ip address laptop/pc atau URL server
		$actualpath = $server.$path;

		$sql = "INSERT INTO bencana (nama_bencana, lat, lng, tgl, lokasi, korban, kerugian, penyebab, keterangan, gambar) VALUES ('$nama','$latitude','$longtitude', '$date', '$lokasi', '$korban', '$kerugian', '$penyebab', '$ket', '$actualpath')";

		$result = mysqli_query($con,$sql);

		if ($result) {
			file_put_contents($path,base64_decode($gambar));
			$response["success"] = 1;
			$response["success"] = "Berhasil";
			echo json_encode($response);
		}else{
			$response["success"] = 0;
			$response["success"] = "Gagal";
			echo json_encode($response);
		}
 }

 	// fungsi random string pada gambar untuk menghindari nama file yang sama
	function random_word($id = 20){
		$pool = '1234567890abcdefghijkmnpqrstuvwxyz';
		
		$word = '';
		for ($i = 0; $i < $id; $i++){
			$word .= substr($pool, mt_rand(0, strlen($pool) -1), 1);
		}
		return $word; 
	}

	mysqli_close($con);
?>