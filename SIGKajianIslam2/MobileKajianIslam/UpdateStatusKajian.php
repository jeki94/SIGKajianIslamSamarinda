<?php
include_once "../settings/koneksi.php";


 $response = array();
 if($_SERVER['REQUEST_METHOD']=='POST'){
 	 
	$id_kajian = $_POST['id_kajian'];
	$username = $_POST['username'];

	$status = $_POST['statuskajian'];

		//$sql .= "UPDATE formkajian SET id_username = (SELECT id_username FROM username WHERE username='$username') WHERE formkajian.id_kajian=LAST_INSERT_ID()";
	// $status bisa dirubah langsung namun harus membuat php seperti ini lagi untuk status yang lain
		$sql = "UPDATE formkajian set statuskajian = '$status', id_username = (SELECT id_username FROM username WHERE username='$username' && status='Verifikasi' ) where id_kajian = $id_kajian;";

		$result = mysqli_multi_query($con,$sql);

if ($result) {
			//ntar dulu
			// require_once('/service/push_notification.php');
			// require_once('../../MapsBencanaWeb/service/PushNotification.php');

			// require_once('../../MapsBencanaWeb/service/PushNotification.php');
			//
			$response["success"] = 1;
			$response["success"] = "Berhasil Merubah Status Kajian";

		// $response["success"] = $nama.$longtitude.$latitude.$date.$lokasi.$korban.$kerugian.$penyebab.$gambar.$ket.$username;

			echo json_encode($response);
		}else{
			$response["success"] = 0;
			$response["success"] = "Gagal Merubah Status Kajian";
			echo json_encode($response);
		}
	}

?>