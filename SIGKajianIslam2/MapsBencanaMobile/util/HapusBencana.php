<?php
	
include("../../settings/koneksi.php");

class hapusbencana{}
 $response = array();
 if($_SERVER['REQUEST_METHOD']=='POST'){
 	//Mendapatkan Nilai Variable
		$id_bencana = $_POST['id_bencana'];


		$sql = "DELETE FROM bencana WHERE id_bencana=$id_bencana";

		$result = mysqli_query($con,$sql);

		if ($result) {
			$response = new hapusbencana();
			$response->success = 1;
			$response->message = "Berhasil Menghapus";
			die(json_encode($response));
		}else{

			$response = new hapusbencana();
			$response->success = 1;
			$response->message = "Gagal Menghapus";
			die(json_encode($response));
		}
	}

?>