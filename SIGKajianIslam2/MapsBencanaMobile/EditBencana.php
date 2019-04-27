<?php 
 
	if($_SERVER['REQUEST_METHOD']=='POST'){
		//MEndapatkan Nilai Dari Variable 
		$id = $_POST['id'];
		$name = $_POST['nama_bencana'];
		$latitude = $_POST['lat'];
		$longtitude = $_POST['lng'];
		$date = date("Y-m-d H:i:s");
		$ket =$_POST['keterangan'];
		
		//import file koneksi database 
		include_once "../../settings/koneksi.php";
		
		//Membuat SQL Query
		$sql = "UPDATE bencana SET nama_bencana = '$name', lat = '$latitude', lng = '$longtitude', tgl = '$date', keterangan = 'ket' WHERE id = $id;";
		
		//Meng-update Database 
		if(mysqli_query($con,$sql)){
			echo 'Berhasil Update Data Pegawai';
		}else{
			echo 'Gagal Update Data Pegawai';
		}
		
		mysqli_close($con);
?>