<?php

include("../settings/koneksi.php");
$response = array();

	$query = mysqli_query($con,"SELECT * FROM kelurahan");

	// $list_kelurahan = mysql_query($query);

	if (mysqli_num_rows($query) > 0) {
		$response["kelurahan"] = array();

		while ($row = mysqli_fetch_array($query)) {
			$kelurahan = array();
			$kelurahan["id_kelurahan"] 	= $row["id_kelurahan"];
			$kelurahan["namakelurahan"] = $row["namakelurahan"];
			$kelurahan["id_kecamatan"] 	= $row["id_kecamatan"];

			array_push($response["kelurahan"],$kelurahan);
		}

		$response["success"] = 1;
		echo json_encode($response);
	}else{
		$response["success"] = 0;
		$response["message"] = "nggak ada data";
		echo json_encode($response);
	}

?>