<?php
include_once "../settings/koneksi.php";

 $response = array();
 if($_SERVER['REQUEST_METHOD']=='POST'){
 	//Mendapatkan Nilai Variable
 	// tabel identitas
	$id_kajian = $_POST['id_kajian'];
	$namakajian = $_POST['namakajian'];
 	$namapemateri = $_POST['namapemateri'];
 	$namatempat = $_POST['namatempat'];
	$latitude = $_POST['latitude'];
	$longtitude = $_POST['longtitude'];
	date_default_timezone_set("Asia/Singapore");
	$date = date('Y-m-d H:i:s');
	$alamat = $_POST['alamat'];
	$kelurahan = $_POST['kelurahan'];
	$kecamatan = $_POST['kecamatan'];
	$tanggalkajian = $_POST['tanggalkajian'];
	$waktumulai = $_POST['waktumulai'];
	$waktuselesai = $_POST['waktuselesai'];
	$statuspeserta = $_POST['statuspeserta'];
	$kuotapeserta = $_POST['kuotapeserta'];
	// $statuskajian = $_POST['statuskajian'];
	$statusberbayar = $_POST['statusberbayar'];
	$pengelola = $_POST['pengelola'];
	$kontakpengelola = $_POST['kontakpengelola'];
	$informasi = $_POST['informasi'];
	$username = $_POST['username'];

	// $random = random_word(20);
	//$check = getimagesize($_FILES["satu"]["tmp_name"]);
	//$check2 = getimagesize($_FILES["dua"]["tmp_name"]);
	$status = $noVerifikasi;
	$token = $default;

	// encode&decode gambar
	if(isset($_POST['gambarposter'])){
		define('UPLOAD_DIR', '../image/poster/');
		$gambar = $_POST['gambarposter'];
	    $gambar = str_replace('data:image/JPEG;base64,', '', $gambar);
	    $gambar = str_replace(' ', '+', $gambar);
	    $data = base64_decode($gambar);
	    $gambarNama = 'IMG_'.uniqid() . '.png';
	    $file = UPLOAD_DIR . $gambarNama;
	    $success = file_put_contents($file, $data);
	    $finalImage = $imagePoster.$gambarNama;
	}
	
	if (isset($_POST['gambartempat'])) {
		define('UPLOAD_DIR2', '../image/tempat/');
		$gambar2 = $_POST['gambartempat'];
		$gambar2 = str_replace('data:image/JPEG;base64,', '', $gambar2);
		$gambar2 = str_replace(' ', '+', $gambar2);
		$data2 = base64_decode($gambar2);
		$gambarNama2 = 'IMG_'.uniqid() . '.png';
		$file2 = UPLOAD_DIR2 . $gambarNama2;
		$success2 = file_put_contents($file2, $data2);
		$finalImage2 = $imageTempat.$gambarNama2;
	}

		// define('UPLOAD_DIR', '../image/poster/');
		// $gambar = $_POST['gambarposter'];
	 //    $gambar = str_replace('data:image/JPEG;base64,', '', $gambar);
	 //    $gambar = str_replace(' ', '+', $gambar);
	 //    $data = base64_decode($gambar);
	 //    $gambarNama = 'IMG_'.uniqid() . '.png';
	 //    $file = UPLOAD_DIR . $gambarNama;
	 //    $success = file_put_contents($file, $data);
	 //    $finalImage = $server.$imagePoster.$gambarNama;

	 //    define('UPLOAD_DIR2', '../image/tempat/');
		// $gambar2 = $_POST['gambartempat'];
	 //    $gambar2 = str_replace('data:image/JPEG;base64,', '', $gambar2);
	 //    $gambar2 = str_replace(' ', '+', $gambar2);
	 //    $data2 = base64_decode($gambar2);
	 //    $gambarNama2 = 'IMG_'.uniqid() . '.png';
	 //    $file2 = UPLOAD_DIR2 . $gambarNama2;
	 //    $success2 = file_put_contents($file2, $data2);
	 //    $finalImage2 = $server.$imageTempat.$gambarNama2;
	// end encode&decode gambar

		$sql = "UPDATE formkajian SET namakajian='$namakajian',namapemateri='$namapemateri',namatempat='$namatempat', lat='$latitude', lng='$longtitude'";
	$sql .= (isset($finalImage)) ? ",fotoposter='$finalImage'" : "";
	$sql .= (isset($finalImage2)) ? ",fototempat='$finalImage2'" : "";
	$sql .= ",alamat='$alamat', kelurahan='$kelurahan',kecamatan='$kecamatan',tanggalkajian='$tanggalkajian',waktumulai='$waktumulai',waktuselesai='$waktuselesai',kuota='$kuotapeserta',statuspeserta='$statuspeserta',statuskajian='Aktif',statusberbayar='$statusberbayar',
		Pengelola='$pengelola',kontakpengelola='$kontakpengelola',informasi='$informasi' WHERE formkajian.id_kajian = '$id_kajian';";
		//$sql .= "UPDATE formkajian SET id_username = (SELECT id_username FROM username WHERE username='$username') WHERE formkajian.id_kajian=LAST_INSERT_ID()";

		$result = mysqli_multi_query($con,$sql);

if ($result) {
			//ntar dulu
			// require_once('/service/push_notification.php');
			// require_once('../../MapsBencanaWeb/service/PushNotification.php');

			// require_once('../../MapsBencanaWeb/service/PushNotification.php');
			//
			$response["success"] = 1;
			$response["success"] = "Berhasil Merubah Kajian";

		// $response["success"] = $nama.$longtitude.$latitude.$date.$lokasi.$korban.$kerugian.$penyebab.$gambar.$ket.$username;

			echo json_encode($response);
		}else{
			$response["success"] = 0;
			$response["success"] = "Gagal Merubah Kajian";
			echo json_encode($response);
		}
	}

?>