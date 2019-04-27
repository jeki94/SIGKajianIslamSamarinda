<?php

include("../../settings/koneksi.php");

 $response = array();
 if($_SERVER['REQUEST_METHOD']=='POST'){
 	//Mendapatkan Nilai Variable
 	// tabel identitas
		$nama = $_POST['nama'];
		$alamat = $_POST['alamat'];
		$no_telp = $_POST['no_telp'];
		$no_identitas = $_POST['no_identitas'];
		$bukti_identitas= $_POST['gambar'];

	//tabel user
		$username = $_POST['username'];
		$pass = $_POST['password'];
		$email = $_POST['email'];
		$role = $user;
		$status = $noVerifikasi;
		$token = $default;

	//decode gambar
	    define('UPLOAD_DIR', '../../image/bukti_identitas/');
		$gambar = $_POST['gambar'];
	    $gambar = str_replace('data:image/JPEG;base64,', '', $gambar);
	    $gambar = str_replace(' ', '+', $gambar);
	    $data = base64_decode($gambar);
	    $gambarNama = 'IMG_USR('.uniqid() . ').png';
	    $file = UPLOAD_DIR . $gambarNama;
	    $success = file_put_contents($file, $data);
	    $finalImage = $server.$imageIdentitas.$gambarNama;
	//end decode gambar

		$sql = "INSERT INTO identitas(nama,alamat,email,no_telp,no_identitas,bukti_identitas)VALUES('$nama','$alamat','$email','$no_telp','$no_identitas','$finalImage');";
		$sql .="INSERT INTO user(username,pass,role,status,token,id_identitas)VALUES('$username','$pass','$role','$status','$token',LAST_INSERT_ID());";

		$check="SELECT * FROM user WHERE username = '$username' && pass='$pass'";

		$rs = mysqli_query($con,$check);
		$data = mysqli_fetch_array($rs, MYSQLI_NUM);
		if($data[0] > 1) {
			echo "Username anda telah digunakan";
		}else{
			$result = mysqli_multi_query($con,$sql);
			if ($result) {
			$response["success"] = 1;
			$response["success"] = "Berhasil";
			echo json_encode($response);
			}else{
			$response["success"] = 0;
			$response["success"] = "Gagal";
			echo json_encode($response);
		}
	}
}

?>
