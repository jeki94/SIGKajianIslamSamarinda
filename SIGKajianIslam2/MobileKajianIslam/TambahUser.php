<?php
include_once "../settings/koneksi.php";


 $response = array();
 if($_SERVER['REQUEST_METHOD']=='POST'){
 	//Mendapatkan Nilai Variable
 	// tabel identitas
	$username = $_POST['username'];
	$password = $_POST['password'];
 	$nama = $_POST['nama'];
	$tempatlahir = $_POST['tempatlahir'];
	$tanggallahir = $_POST['tanggallahir'];
	$alamat = $_POST['alamat'];
	//$kecamatan = $_POST['kecamatan'];
	$kelurahan = $_POST['kelurahan'];
	$kecamatan = $_POST['kecamatan'];
	$email = $_POST['email'];
	$sosialmedia = $_POST['sosialmedia'];
	$no_telepon = $_POST['no_telepon'];
	$no_ktp = $_POST['no_ktp'];
	$level = $_POST['level'];
		$role = $user;
		$status = $noVerifikasi;
		$token = $default;

	//decode gambar
	//     define('UPLOAD_DIR', '../../image/foto3x4/');
	// $gambar = base64_encode(file_get_contents( $_FILES["satu"]["tmp_name"] ));
 //    $gambar = str_replace('data:image/JPEG;base64,', '', $gambar);
 //    $gambar = str_replace(' ', '+', $gambar);
 //    $data = base64_decode($gambar);
 //    $gambarNama = 'IMG_USR('.uniqid() . ').png';
 //    $file = UPLOAD_DIR . $gambarNama;
 //    $success = file_put_contents($file, $data);
 //    $finalImage = $server.$imageFoto3x4.$gambarNama;

    define('UPLOAD_DIR2', '../image/ktp/');
    $gambar2 = $_POST['fotoktp'];
	// $gambar2 = base64_encode(file_get_contents( $_FILES["dua"]["tmp_name"] ));
    $gambar2 = str_replace('data:image/JPEG;base64,', '', $gambar2);
    $gambar2 = str_replace(' ', '+', $gambar2);
    $data2 = base64_decode($gambar2);
    $gambarNama2 = 'IMG_USR('.uniqid() . ').png';
    $file2 = UPLOAD_DIR2 . $gambarNama2;
    $success2 = file_put_contents($file2, $data2);
    $finalImage2 = $imageKTP.$gambarNama2;

		$sql = "INSERT INTO pengguna (id_pengguna, Nama, tempatlahir, tanggallahir, alamat, kelurahan, kecamatan, email, sosialmedia, fotoktp, nomorktp, no_telepon) VALUES (NULL, '$nama', '$tempatlahir', '$tanggallahir', '$alamat', '$kelurahan', '$kecamatan', '$email', '$sosialmedia', '$finalImage2', '$no_ktp', '$no_telepon');";

    		$sql .="INSERT INTO username(username,password,token,status,level,id_pengguna)VALUES('$username','$password','$token','$status','User',LAST_INSERT_ID());";

		$check="SELECT * FROM username WHERE username = '$username' && password='$password' && status=='Blocked'";
		
		$rs = mysqli_query($con,$check);
		$data = mysqli_fetch_array($rs, MYSQLI_NUM);
		if($data[0] > 1) {
			echo "Username anda telah digunakan";
		}else{
			$result = mysqli_multi_query($con,$sql);
			if ($result) {
			$response["success"] = 1;
			$response["success"] = "Berhasil";
			header("Location:../VerifikasiUser.php");
			echo json_encode($response);
			}else{
			$response["success"] = 0;
			$response["success"] = "Gagal";
			echo json_encode($response);}
		}
	mysqli_close($con);
}

?>
