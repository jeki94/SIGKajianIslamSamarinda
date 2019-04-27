<?php 
include_once "../settings/koneksi.php";

	class login{}
	
	$username = $_POST["username"];
	$password = $_POST["password"];
	//$token = $_POST["token"];
	
	if ((empty($username)) || (empty($password))) { 
		$response = new Login();
		$response->success = 0;
		$response->message = "Kolom tidak boleh kosong"; 
		die(json_encode($response));
	}
	
	$check = mysqli_query($con, "SELECT * FROM username WHERE username='$username' AND password='$password' AND level='User' AND status='Verifikasi'");
	//$regToken = "UPDATE user SET token='$token' WHERE username='$username' && pass='$password'";
	
	$row = mysqli_fetch_array($check);

	// $username = $row['username'];
	$status = $row['status'];
	if (!empty($row)){
		if ($status == 'Verifikasi') {
			echo "success";	
			// $result = mysqli_multi_query($con,$regToken);
			// if ($result) {

			// }
		}
		else{
			echo "Username Belum Diverifikasi";
		}

	} else { 

		echo "Username atau Password Salah";
	}
	
	mysqli_close($con); 
 ?>
