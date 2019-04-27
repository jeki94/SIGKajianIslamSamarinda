<?php
include('../../settings/koneksi.php') ;


// login
if(isset($_POST["login"]))
{

$username =$_POST['username'];
$password =$_POST['password'];
$token =$_POST['token'];

// $cek = mysqli_query($con,"select * from user where username='$username' && pass='$password' && status='Verified'");

	$check = mysqli_query($con, "SELECT * FROM username WHERE username='$username' AND password='$password' AND level='admin'");
	$regToken = "UPDATE username SET token='$token' WHERE username='$username' && password='$password' AND level='admin'";
	
	$row = mysqli_fetch_array($check);

	$username = $row['username'];
	$status = $row['status'];
	if (!empty($row)){
		if ($status == "Verifikasi") {
			$result = mysqli_multi_query($con,$regToken);
			if ($result) {

			session_start();
			$username =$username;
			$_SESSION['username'] = $username;
			$_SESSION['status'] = "login";
			// ngecek nunggu restart
			if(!empty($_POST["remember"])) {
						setcookie ("member_login",$username,time()+ (10 * 365 * 24 * 60 * 60));
						setcookie ("member_password",$password,time()+ (10 * 365 * 24 * 60 * 60));
					} else {
						if(isset($_COOKIE["member_login"])) {
							setcookie ("member_login","");
						}
						if(isset($_COOKIE["member_password"])) {
							setcookie ("member_password","");
						}
					}

			header("location:/SIGKajianIslam2/WebKajianIslam/NewDashboard.php");
			echo "ok";
			exit(); 
			}	
		}
		else{
			 $message = "Username Belum Diverifikasi.";
			 echo "<script type='text/javascript'>alert('$message');window.top.location='/SIGKajianIslam/WebKajianIslam/index.php';</script>";
		}

	} else { 

		 $message = "Username atau Password salah.\\nCoba Lagi.";
  		 echo "<script type='text/javascript'>alert('$message');window.top.location='/SIGKajianIslam/WebKajianIslam/index.php';</script>";
	}

}
// end login

// function bencana

// lihat gambar tempat
if(isset($_POST['rowidGmb'])) {

    $id = $_POST['rowidGmb'];
    // mengambil data berdasarkan id
    $sql = "SELECT * FROM formkajian WHERE id_kajian = $id";
    $result = mysqli_query($con,$sql);
    // $result = $koneksi->query($sql);

    if( $result ) { 
   	foreach ( $result as $data ) {
   		echo "<img src=".$data['fototempat']." class='img-responsive'>";
   		// echo $data['gambar']."silit";
   	} // endforeach 
   }
}

if(isset($_POST['rowidGmb2'])) {

    $id = $_POST['rowidGmb2'];
    // mengambil data berdasarkan id
    $sql = "SELECT * FROM formkajian WHERE id_kajian = $id";
    $result = mysqli_query($con,$sql);
    // $result = $koneksi->query($sql);

    if( $result ) { 
   	foreach ( $result as $data ) {
   		echo "<img src=".$data['fotoposter']." class='img-responsive'>";
   		// echo $data['gambar']."silit";
   	} // endforeach 
   }
}
// end lihat gambar bencana

// lihat detail bencana
if(isset($_POST['rowidDetBen'])) {

    $id = $_POST['rowidDetBen'];
    // mengambil data berdasarkan id
    $sql = "SELECT namakajian,namapemateri,namatempat,fotoposter,fototempat,lat,lng,alamat,kelurahan,kecamatan,tanggalkajian,waktumulai,waktuselesai,kuota,statuspeserta,statuskajian,statusberbayar,pengelola,kontakpengelola,informasi, username.username FROM formkajian JOIN username ON formkajian.id_username = username.id_username WHERE id_kajian='$id' ";
    $result = mysqli_query($con,$sql);
    // $result = $koneksi->query($sql);

    if( $result ) { 
   	foreach ( $result as $data ) {

   		// $id = $data['id_kajian'];
   		$namakajian = $data['namakajian'];
		$namapemateri = $data['namapemateri'];
		$namatempat = $data['namatempat'];
		$alamat = $data['alamat'];
		$kelurahan = $data['kelurahan'];
		$kecamatan = $data['kecamatan'];
		$tanggalkajian = $data['tanggalkajian'];
		$tanggal = date_format (new DateTime($tanggalkajian), 'd-m-Y');
		$waktumulai = $data['waktumulai'];
		$waktuselesai = $data['waktuselesai'];
		$kuota = $data['kuota'];
		$statuspeserta = $data['statuspeserta'];
		$statuskajian = $data['statuskajian'];
		$statusberbayar = $data['statusberbayar'];
		$pengelola = $data['pengelola'];
		$kontakpengelola = $data['kontakpengelola'];
		$informasi = $data['informasi'];
		$finformasi= str_replace("/", "'", $informasi);
		//$author = $data['username'];
  //  		$tgl = $data['tgl'];
		// $tanggal = date_format (new DateTime($tgl), 'd-m-Y');
		// $waktu = date_format (new DateTime($tgl), 'H:i:s');

		// $korban = $data['korban'];
		// list ($tewas, $berat, $ringan ) = explode(";", $korban);
		echo "<label>Poster Kajian</label></br> <img src=".$data['fotoposter']." class='img-responsive'></br>";
   		echo "<label>Foto Tempat</label></br> <img src=".$data['fototempat']." class='img-responsive'></br>";
		echo "<label>Nama Kajian</label></br>"; echo "<p>".$namakajian."</p><br/>";
		echo "<label>Nama Pemateri</label></br>"; echo "<p>".$namapemateri."</p><br/>";
   		echo "<label>Alamat</label></br>"; echo "<p>".$alamat."</p><br/>";
   		echo "<label>Kelurahan</label></br>"; echo "<p>".$kelurahan."</p><br/>";
   		echo "<label>Kecamatan</label></br>"; echo "<p>".$kecamatan."</p><br/>";
   		echo "<label>Tanggal Kajian</label></br>"; echo "<p>".$tanggalkajian."</p><br/>";
   		echo "<label>Waktu Mulai</label></br>"; echo "<p>".$waktumulai."</p><br/>";
   		echo "<label>Waktu Selesai</label></br>"; echo "<p>".$waktuselesai."</p><br/>";
   		echo "<label>Kuota</label></br>"; echo "<p>".$kuota."</p><br/>";
   		echo "<label>Status Peserta</label></br>"; echo "<p>".$statuspeserta."</p><br/>";
   		echo "<label>Status Berbayar</label></br>"; echo "<p>".$statusberbayar."</p><br/>";
   		echo "<label>Pengelola</label></br>"; echo "<p>".$pengelola."</p><br/>";
   		echo "<label>Kontak Pengelola</label></br>"; echo "<p>".$kontakpengelola."</p><br/>";
   		echo "<label>Informasi</label></br>"; echo "<p>".$finformasi."</p><br/>";

   		// echo "<label>Nama Bencana</label></br>"; echo "<p>".$data['nama_bencana']."</p><br/>";
   		// echo "<label>Tanggal & Waktu Bencana</label></br>"; echo "<p>".$tanggal."(".$waktu.")"."</p><br/>";
   		// echo "<label>Lokasi Bencana</label></br>"; echo "<p>".$data['lokasi']."</p><br/>";
   		// echo "<label>Korban Bencana</label></br>"; echo "<p>Korban Tewas : ".$tewas." || Korban Luka Berat : ".$berat." || Korban Luka Ringan : ".$ringan."</p><br/>";
   		// echo "<label>Kerugian </label></br>"; echo "<p>".$data['kerugian']."</p><br/>";
   		// echo "<label>Penyebab Bencana</label></br>"; echo "<p>".$data['penyebab']."</p><br/>";
   		// echo "<label>Keterangan</label></br>"; echo "<p>".$data['keterangan']."</p><br/>";

   		// echo $data['gambar']."silit";
   	} // endforeach 
   }
}
// end lihat detail bencana

// tambah kajian
if(isset($_POST['TambahKajian']))
{
 	$namakajian = $_POST['namakajian'];
 	$namapemateri = $_POST['namapemateri'];
 	$namatempat = $_POST['tempatkajian'];
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
	$statuskajian = $_POST['statuskajian'];
	$statusberbayar = $_POST['statusberbayar'];
	$pengelola = $_POST['pengelola'];
	$kontakpengelola = $_POST['kontakpengelola'];
	$informasi = $_POST['informasi'];
	$username = $_POST['username'];

	// echo "nama kajian : $namakajian; <br/>
	// tempat : $namatempat;<br/>
	// long : $longtitude;<br/>
	// lat : $latitude;<br/>
	// date : $date;<br/>
	// alamat : $alamat;<br/>
	// kelurahan : $kelurahan;<br/>
	// tanggal kajain : $tanggalkajian;<br/>
	// mulai : $waktumulai;<br/>
	// selesai : $waktuselesai;<br/>
	// status p : $statuspeserta;<br/>
	// kuota p : $kuotapeserta;<br/>
	// status kajian : $statuskajian;<br/>
	// s bayar : $statusberbayar;<br/>
	// pengelola : $pengelola;<br/>
	// kontak p : $kontakpengelola;<br/>
	// inf : $informasi;<br/>
	// usm : $username;<br/>";

	$random = random_word(20);
	//$check = getimagesize($_FILES["satu"]["tmp_name"]);
	//$check2 = getimagesize($_FILES["dua"]["tmp_name"]);
	$status = $noVerifikasi;
	$token = $default;

	// encode&decode gambar
	define('UPLOAD_DIR', '../../image/poster/');
	$gambar = base64_encode(file_get_contents( $_FILES["satu"]["tmp_name"] ));
    $gambar = str_replace('data:image/JPEG;base64,', '', $gambar);
    $gambar = str_replace(' ', '+', $gambar);
    $data = base64_decode($gambar);
    $gambarNama = 'IMG_USR('.uniqid() . ').png';
    $file = UPLOAD_DIR . $gambarNama;
    $success = file_put_contents($file, $data);
    $finalImage = $server.$imagePoster.$gambarNama;

    define('UPLOAD_DIR2', '../../image/tempat/');
	$gambar2 = base64_encode(file_get_contents( $_FILES["dua"]["tmp_name"] ));
    $gambar2 = str_replace('data:image/JPEG;base64,', '', $gambar2);
    $gambar2 = str_replace(' ', '+', $gambar2);
    $data2 = base64_decode($gambar2);
    $gambarNama2 = 'IMG_USR('.uniqid() . ').png';
    $file2 = UPLOAD_DIR2 . $gambarNama2;
    $success2 = file_put_contents($file2, $data2);
    $finalImage2 = $server.$imageTempat.$gambarNama2;
	// end encode&decode gambar

		$sql = "INSERT INTO formkajian (namakajian,namapemateri, namatempat, lat, lng, fotoposter, fototempat, alamat, kelurahan,kecamatan, tanggalkajian, waktumulai, waktuselesai, kuota, statuspeserta, statuskajian, statusberbayar, Pengelola, kontakpengelola, informasi, id_username) VALUES ('$namakajian','$namapemateri','$namatempat','$latitude','$longtitude', '$finalImage','$finalImage2','$alamat','$kelurahan','$kecamatan','$tanggalkajian','$waktumulai','$waktuselesai','$kuotapeserta','$statuspeserta','$statuskajian','$statusberbayar','$pengelola','$kontakpengelola','$informasi',(SELECT id_username FROM username WHERE username='$username'));";
		//$sql .= "UPDATE formkajian SET id_username = (SELECT id_username FROM username WHERE username='$username') WHERE formkajian.id_kajian=LAST_INSERT_ID()";

		$result = mysqli_multi_query($con,$sql);

if ($result) {
		
		// file_put_contents($path,base64_decode($data));
		$response["success"] = 1;
		$response["success"] = "Berhasil";
		$mes = "Berhasil Menambah Kajian";
		echo "<script>alert('".$mes."');window.location.href='../ListKajian.php';</script>";
		}else{
		$response["success"] = 0;
		$response["success"] = "Gagal";
		}
	mysqli_close($con);
}

// 	if ($result) {
		
// 		// file_put_contents($path,base64_decode($data));
// 		$response["success"] = 1;
// 		$response["success"] = "Berhasil";
// 		$mes = "Berhasil Menambahkan";
// 		echo "<script>alert('".$mes."');window.location.href='../ListKajian.php';</script>";
// 		include("PushNotification.php");		
// 		// echo "<script>alert('".$mes."tewas".$tewas."berat".$berat."ringan".$ringan."jumlah korban (".$korban.")"."');window.location.href='../dashboard.php';</script>";
// 		echo json_encode($response);
// 		}else{
// 		$response["success"] = 0;
// 		$response["success"] = "Gagal";
// 		echo json_encode($response);
// 		}
// 	mysqli_close($con);
// }

// end tambah bencana

// show bencana
if(isset($_POST['LihatBencana'])) {

    $id = $_POST['LihatBencana'];
    // mengambil data berdasarkan id
    $sql = "SELECT * FROM bencana WHERE id_bencana= $id";
    $result = mysqli_query($con,$sql);
    // $result = $koneksi->query($sql);

    if( $result ) { 
   	foreach ( $result as $data ) {
   		// echo $data['nama_bencana']."silit";
   		$lokasi = $data['lokasi'];?>

   		<form role="form" method="post" action="service/function.php" enctype="multipart/form-data">
   		<div class="form-group">
		<label>Nama Lokasi</label>
   		<input class="form-control" placeholder="Lokasi Bencana" name="lokasi" required value="<?php echo $lokasi ?>">
   		</div>
   		</form>

   		<?php
   	} // endforeach 
   }
   else{ 
   echo 'Error Load';
   }//endif $users

    mysqli_close($con);
}
// end show bencana

// edit data kajian
if (isset($_POST['EditKajian'])) {
 	
 	//$idkajian = $_GET['idkajian'];
 	$idkajian = $_POST['idkajian'];
 	$namakajian = $_POST['namakajian'];
 	$namapemateri = $_POST['namapemateri'];
 	$namatempat = $_POST['tempatkajian'];
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
	$statuskajian = $_POST['statuskajian'];
	$statusberbayar = $_POST['statusberbayar'];
	$pengelola = $_POST['pengelola'];
	$kontakpengelola = $_POST['kontakpengelola'];
	$informasi = $_POST['informasi'];
	$finformasi= str_replace("'", "/", $informasi);
	$username = $_POST['username'];

	$random = random_word(20);
	//$check = getimagesize($_FILES["sgambar"]["tmp_name"]);

	// encode&decode gambar
	if($_FILES["satu"]["tmp_name"] != ''){
		define('UPLOAD_DIR', '../../image/poster/');
		$gambar = base64_encode(file_get_contents( $_FILES["satu"]["tmp_name"] ));
		$gambar = str_replace('data:image/JPEG;base64,', '', $gambar);
		$gambar = str_replace(' ', '+', $gambar);
		$data = base64_decode($gambar);
		$gambarNama = 'IMG_USR('.uniqid() . ').png';
		$file = UPLOAD_DIR . $gambarNama;
		$success = file_put_contents($file, $data);
		$finalImage = $server.$imagePoster.$gambarNama;
	}
	
	if ($_FILES["dua"]["tmp_name"] != '') {
		define('UPLOAD_DIR2', '../../image/tempat/');
		$gambar2 = base64_encode(file_get_contents( $_FILES["dua"]["tmp_name"] ));
		$gambar2 = str_replace('data:image/JPEG;base64,', '', $gambar2);
		$gambar2 = str_replace(' ', '+', $gambar2);
		$data2 = base64_decode($gambar2);
		$gambarNama2 = 'IMG_USR('.uniqid() . ').png';
		$file2 = UPLOAD_DIR2 . $gambarNama2;
		$success2 = file_put_contents($file2, $data2);
		$finalImage2 = $server.$imageTempat.$gambarNama2;
	}
	// end encode&decode gambar


	$sql = "UPDATE formkajian SET namakajian='$namakajian',namapemateri='$namapemateri',namatempat='$namatempat', lat='$latitude', lng='$longtitude'";
	$sql .= (isset($finalImage)) ? ",fotoposter='$finalImage'" : "";
	$sql .= (isset($finalImage2)) ? ",fototempat='$finalImage2'" : "";
	$sql .= ",alamat='$alamat', kelurahan='$kelurahan',kecamatan='$kecamatan',tanggalkajian='$tanggalkajian',waktumulai='$waktumulai',waktuselesai='$waktuselesai',kuota='$kuotapeserta',statuspeserta='$statuspeserta',statuskajian='$statuskajian',statusberbayar='$statusberbayar',
		Pengelola='$pengelola',kontakpengelola='$kontakpengelola',informasi='$finformasi' WHERE formkajian.id_kajian = '$idkajian';";
	

	$result = mysqli_query($con,$sql);

	if ($result) {
		
		// file_put_contents($path,base64_decode($data));
		$response["success"] = 1;
		$response["success"] = "Berhasil";
		$mes = "Berhasil Mengedit Kajian";
		echo "<script>alert('".$mes."');window.location.href='../ListKajian.php';</script>";
		}else{
		$response["success"] = 0;
		$response["success"] = "Gagal";
		}
	mysqli_close($con);
}
// edit data bencana

// hapus bencana
if (isset($_POST['HapusBencana'])) {
	$id = $_GET['id'];
	$result = mysqli_query($con, "UPDATE bencana SET status='history' WHERE bencana.id_bencana='$id'");
	
	if ($result) {
		echo "Berhasil Menghapus";
		header("Location:../ListBencana.php");
		}else{
		echo "Gagal Menghapus";
		}
	mysqli_close($con);
}
// end hapus bencana

// end edit bencana

// ------------------------RIWAYAT ATAU LAPORAN------------------------------
if (isset($_POST['tahun'])) {

	$tahun = $_POST['tahun'];
	$bulan = $_POST['bulan'];

	?>
<div id="table_content" class="table-responsive" style="margin: 5px;">
<table class="table">
<thead>
	<tr>
	<th>Nama Kajian</th>
	<th>Nama Pemateri</th>
	<th>Nama Tempat</th>
	<th>Alamat</th>
	<th>Kelurahan</th>
	<th>Kecamatan</th>
	<th>Tanggal Kajian</th>
	<th>Waktu Mulai</th>
	<th>Waktu Selesai</th>
	<th>Kuota</th>
	<th>Status Peserta</th>
	<th>Status Berbayar</th>
	<th>Pengelola</th>
	<th>Kontak Pengelola</th>
	<th>Informasi</th>
	<th>Publisher</th>

	</tr>
</thead>

<?php $query = mysqli_query($con,"SELECT namakajian,namapemateri,namatempat,lat,lng,alamat,kelurahan,kecamatan,tanggalkajian,waktumulai,waktuselesai,kuota,statuspeserta,statusberbayar,pengelola,kontakpengelola,informasi, username.username FROM formkajian JOIN username ON formkajian.id_username = username.id_username WHERE formkajian.statuskajian='TelahSelesai' && tanggalkajian LIKE '%".$tahun."-".$bulan."%'"."ORDER BY id_kajian && MONTH(tanggalkajian) = MONTH(CURRENT_DATE) DESC "); 
// <?php $query = mysqli_query($con,"SELECT * FROM formkajian WHERE tanggalkajian LIKE '%".$tahun."-".$bulan."%'"); 
while ($data = mysqli_fetch_array($query)){

						$namakajian = $data['namakajian'];
						$namapemateri = $data['namapemateri'];
						$namatempat = $data['namatempat'];
						$alamat = $data['alamat'];
						$kelurahan = $data['kelurahan'];
						$kecamatan = $data['kecamatan'];
						$tanggalkajian = $data['tanggalkajian'];
						$tanggal = date_format (new DateTime($tanggalkajian), 'd-m-Y');
						$waktumulai = $data['waktumulai'];
						$waktuselesai = $data['waktuselesai'];
						$kuota = $data['kuota'];
						$statuspeserta = $data['statuspeserta'];
						$statusberbayar = $data['statusberbayar'];
						$pengelola = $data['pengelola'];
						$kontakpengelola = $data['kontakpengelola'];
						$informasi = $data['informasi'];
						$finformasi= str_replace("/", "'", $informasi);
						$author = $data['username'];

echo ("
	<tbody>
	<tr>
	<td>$namakajian</td>
	<td>$namapemateri</td>
							<td>$namatempat</td>
							<td>$alamat</td>
							<td>$kelurahan</td>
							<td>$kecamatan</td>
							<td>$tanggalkajian</td>
							<td>$waktumulai</td>
							<td>$waktuselesai</td>
							<td>$kuota</td>
							<td>$statuspeserta</td>
							<td>$statusberbayar</td>
							<td>$pengelola</td>
							<td>$kontakpengelola</td>
							<td>$finformasi</td>
							<td>$author</td>");}?>
	</tbody>
</table>
</div>
<?php
mysqli_close($con); // disini belum d cek nambah tadi
}
// ------------------------END RIWAYAT ATAU LAPORAN------------------------------
// end function bencana

// =============================================================== END BENCANA ===============================================================

// ================================================================ User =====================================================================

// lihat gambar bukti user
if(isset($_POST['rowidGmbUsr'])) {

    $id = $_POST['rowidGmbUsr'];
    // mengambil data berdasarkan id
    $sql = "SELECT * FROM pengguna WHERE id_pengguna= $id";
    $result = mysqli_query($con,$sql);
    // $result = $koneksi->query($sql);

    if( $result ) { 
   	foreach ( $result as $data ) {
   		echo "<img src=".$data['fotoktp']." class='img-responsive'>";
   		// echo $data['gambar']."silit";
   	} // endforeach 
   }
}
// end lihat gambar bukti user

// if(isset($_POST['rowidGmbUsr2'])) {

//     $id = $_POST['rowidGmbUsr2'];
//     // mengambil data berdasarkan id
//     $sql = "SELECT * FROM pengguna WHERE id_pengguna= $id";
//     $result = mysqli_query($con,$sql);
//     // $result = $koneksi->query($sql);

//     if( $result ) { 
//    	foreach ( $result as $data ) {
//    		echo "<img src=".$data['foto3x4']." class='img-responsive'>";
//    		// echo $data['gambar']."silit";
//    	} // endforeach 
//    }
// }

// verifikasi user
if(isset($_POST['VerifikasiUser'])) {

	$id = $_GET['id'];
	$result = mysqli_query($con, "UPDATE username SET status='Verifikasi' WHERE id_username='$id'" );
	
	if ($result) {
		echo "Berhasil Memverifikasi";
		header("Location:../VerifikasiUser.php");
		}else{
		echo "Gagal Verifikasi";
		}
	// mysqli_close($con);
}
// end verifikasi user

if(isset($_POST['StatusKajian'])) {

	$id = $_GET['id'];
	$result = mysqli_query($con, "UPDATE formkajian SET statuskajian='TelahSelesai' WHERE id_kajian='$id'" );
	
	if ($result) {
		echo "Berhasil Menyimpan di Riwayat";
		header("Location:../ListKajian.php");
		}else{
		echo "Gagal Mengubah Status Kajian";
		}
	// mysqli_close($con);
}

// tambah pengguna
if(isset($_POST['TambahUser']))
{	
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

	
	$random = random_word(20);
	//$check = getimagesize($_FILES["satu"]["tmp_name"]);
	//$check2 = getimagesize($_FILES["dua"]["tmp_name"]);
	$status = $noVerifikasi;
	$token = $default;

	// encode&decode gambar
	// define('UPLOAD_DIR', '../../image/foto3x4/');
	// $gambar = base64_encode(file_get_contents( $_FILES["satu"]["tmp_name"] ));
 //    $gambar = str_replace('data:image/JPEG;base64,', '', $gambar);
 //    $gambar = str_replace(' ', '+', $gambar);
 //    $data = base64_decode($gambar);
 //    $gambarNama = 'IMG_USR('.uniqid() . ').png';
 //    $file = UPLOAD_DIR . $gambarNama;
 //    $success = file_put_contents($file, $data);
 //    $finalImage = $server.$imageFoto3x4.$gambarNama;

    define('UPLOAD_DIR2', '../../image/ktp/');
	$gambar2 = base64_encode(file_get_contents( $_FILES["dua"]["tmp_name"] ));
    $gambar2 = str_replace('data:image/JPEG;base64,', '', $gambar2);
    $gambar2 = str_replace(' ', '+', $gambar2);
    $data2 = base64_decode($gambar2);
    $gambarNama2 = 'IMG_USR('.uniqid() . ').png';
    $file2 = UPLOAD_DIR2 . $gambarNama2;
    $success2 = file_put_contents($file2, $data2);
    $finalImage2 = $server.$imageKTP.$gambarNama2;
	// end encode&decode gambar

		// $sql = "INSERT INTO pengguna(nama,tempatlahir,tanggallahir,alamat,id_kelurahan,email,sosialmedia,foto3x4,fotoktp,nomorktp,no_telepon)VALUES('$nama','$tempatlahir','$tanggallahir','$alamat','1','$email','$sosialmedia','$no_telepon','$finalImage','$finalImage2');";
		// $sql .="INSERT INTO username(username,password,token,status,id_pengguna)VALUES('$username','$password','$token','$status',LAST_INSERT_ID());";

		// $check="SELECT * FROM username WHERE username = '$username' && password='$password'";

   		 $sql = "INSERT INTO pengguna (id_pengguna,Nama, tempatlahir, tanggallahir, alamat, kelurahan,kecamatan, email, sosialmedia, fotoktp, nomorktp, no_telepon) VALUES (NULL, '$nama', '$tempatlahir', '$tanggallahir', '$alamat', '$kelurahan','$kecamatan', '$email', '$sosialmedia','$finalImage2', '$no_ktp', '$no_telepon');";

    		$sql .="INSERT INTO username(username,password,token,status,level,id_pengguna)VALUES('$username','$password','$token','$status','$level',LAST_INSERT_ID());";

		$check="SELECT * FROM username WHERE username = '$username' && password='$password'";
		
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

// end tambah user

// edit user
if (isset($_POST['EditUser'])) {
 	
 	// $id = $_GET['id'];
 	$username = $_POST['username'];
	$password = $_POST['password'];
 	$nama = $_POST['nama'];
	$tempatlahir = $_POST['tempatlahir'];
	$tanggallahir = $_POST['tanggallahir'];
	$alamat = $_POST['alamat'];
	//$kecamatan = $_POST['kecamatan'];
	$kelurahan = $_POST['kelurahan'];
	$kecamatan = $_POST['kecamatan'];
	$uname =$_POST['uname'];//id username
	$ipeng =$_POST['ipeng'];//id pengguna
	$email = $_POST['email'];
	$sosialmedia = $_POST['sosialmedia'];
	$no_telepon = $_POST['no_telepon'];
	$no_ktp = $_POST['no_ktp'];
	$level = $_POST['level'];
	//$id_pengguna = $_POST['id_pengguna'];
	
	$random = random_word(20);
	//$check = getimagesize($_FILES["satu"]["tmp_name"]);
	//$check2 = getimagesize($_FILES["dua"]["tmp_name"]);
	$status = $noVerifikasi;
	$token = $default;

	// encode&decode gambar
	// define('UPLOAD_DIR', '../../image/foto3x4/');
	// $gambar = base64_encode(file_get_contents( $_FILES["satu"]["tmp_name"] ));
 //    $gambar = str_replace('data:image/JPEG;base64,', '', $gambar);
 //    $gambar = str_replace(' ', '+', $gambar);
 //    $data = base64_decode($gambar);
 //    $gambarNama = 'IMG_USR('.uniqid() . ').png';
 //    $file = UPLOAD_DIR . $gambarNama;
 //    $success = file_put_contents($file, $data);
 //    $finalImage = $server.$imageFoto3x4.$gambarNama;

	if ($_FILES["dua"]["tmp_name"] != '') {
		define('UPLOAD_DIR2', '../../image/ktp/');
		$gambar2 = base64_encode(file_get_contents( $_FILES["dua"]["tmp_name"] ));
		$gambar2 = str_replace('data:image/JPEG;base64,', '', $gambar2);
		$gambar2 = str_replace(' ', '+', $gambar2);
		$data2 = base64_decode($gambar2);
		$gambarNama2 = 'IMG_USR('.uniqid() . ').png';
		$file2 = UPLOAD_DIR2 . $gambarNama2;
		$success2 = file_put_contents($file2, $data2);
		$finalImage2 = $server.$imageKTP.$gambarNama2;
	}
	// end encode&decode gambar

	$sql = "UPDATE pengguna SET nama='$nama', tempatlahir='$tempatlahir', tanggallahir='$tanggallahir', alamat='$alamat', kelurahan='$kelurahan', kecamatan='$kecamatan', email='$email', sosialmedia='$sosialmedia'";
	$sql .= (isset($finalImage2)) ? ", fotoktp='$finalImage2'" : "";
	$sql .=	", nomorktp='$no_ktp', no_telepon='$no_telepon' WHERE pengguna.id_pengguna = '$ipeng';";

	$sql .="UPDATE username SET username='$username', password='$password', level='$level' WHERE username.id_username = '$uname';";

	$result = mysqli_multi_query($con,$sql);

	if ($result) {
		
		$response["success"] = 1;
		$response["success"] = "Berhasil";
		$mes = "Berhasil Merubah";
		echo "<script>alert('".$mes."');window.location.href='../ListUser.php';</script>";
		}else{
		$response["success"] = 0;
		$response["success"] = "Gagal";
		}
	mysqli_close($con);
}
// end edit user

// hapus User Permanen
if (isset($_POST['HapusUser'])) {
	$id = $_GET['id'];
	// $result = mysqli_query($con, "DELETE FROM user, identitas USING user, identitas WHERE identitas.id_identitas = user.id_user AND user.id_user = '$id'" );
	$result = mysqli_query($con, "DELETE FROM username WHERE id_username=$id" );
	
	if ($result) {
		echo "Berhasil Menghapus";
		header("Location:../ListUser.php");
		}else{
		echo "Gagal Menghapus";
		}
	mysqli_close($con);
}

if (isset($_POST['BlokirUser'])) {
	$id = $_GET['id'];
	$result = mysqli_query($con, "UPDATE username SET status='Blocked' WHERE id_username='$id'");
	
	if ($result) {
		echo "Berhasil Memblokir";
		header("Location:../ListUser.php");
		}else{
		echo "Gagal Memblokir";
		}
	mysqli_close($con);
}

//Hapus Verifikasi User Permanen
if (isset($_POST['HapusVerifikasiUser'])) {
	$id = $_GET['id'];
	// $result = mysqli_query($con, "DELETE FROM user, identitas USING user, identitas WHERE identitas.id_identitas = user.id_user AND user.id_user = '$id'" );
	$result = mysqli_query($con, "DELETE FROM username WHERE id_username=$id" );
	
	if ($result) {
		echo "Berhasil Menghapus";
		header("Location:../VerifikasiUser.php");
		}else{
		echo "Gagal Menghapus";
		}
	mysqli_close($con);
}

if (isset($_POST['BlokirUserVerifikasi'])) {
	$id = $_GET['id'];
	$result = mysqli_query($con, "UPDATE username SET status='Blocked' WHERE id_username='$id'");
	
	if ($result) {
		echo "Berhasil Memblokir";
		header("Location:../VerifikasiUser.php");
		}else{
		echo "Gagal Memblokir";
		}
	mysqli_close($con);
}

//Hapus Admin Permanen
if (isset($_POST['HapusAdmin'])) {
	$id = $_GET['id'];
	// $result = mysqli_query($con, "DELETE FROM user, identitas USING user, identitas WHERE identitas.id_identitas = user.id_user AND user.id_user = '$id'" );
	$result = mysqli_query($con, "DELETE FROM username WHERE id_username=$id" );
	
	if ($result) {
		echo "Berhasil Menghapus";
		header("Location:../ListAdmin.php");
		}else{
		echo "Gagal Menghapus";
		}
	mysqli_close($con);
}

if (isset($_POST['BlokirAdmin'])) {
	$id = $_GET['id'];
	$result = mysqli_query($con, "UPDATE username SET status='Blocked' WHERE id_username='$id'");
	
	if ($result) {
		echo "Berhasil Memblokir";
		header("Location:../ListAdmin.php");
		}else{
		echo "Gagal Memblokir";
		}
	mysqli_close($con);
}

if (isset($_POST['UnblockUser'])) {
	$id = $_GET['id'];
	$result = mysqli_query($con, "UPDATE username SET status='Verifikasi' WHERE id_username='$id'");
	
	if ($result) {
		echo "Berhasil Meng-unblock";
		header("Location:../BlacklistUser.php");
		}else{
		echo "Gagal Memblokir";
		}
	mysqli_close($con);
}

//Hapus Kajian Permanen
if (isset($_POST['HapusKajian'])) {
	$id = $_GET['id'];
	// $result = mysqli_query($con, "DELETE FROM user, identitas USING user, identitas WHERE identitas.id_identitas = user.id_user AND user.id_user = '$id'" );
	$result = mysqli_query($con, "DELETE FROM formkajian WHERE id_kajian=$id" );
	
	if ($result) {
		echo "Berhasil Menghapus";
		header("Location:../ListKajian.php");
		}else{
		echo "Gagal Menghapus";
		}
	mysqli_close($con);
}

if (isset($_POST['HapusLaporan'])) {
	$id = $_GET['id'];
	// $result = mysqli_query($con, "DELETE FROM user, identitas USING user, identitas WHERE identitas.id_identitas = user.id_user AND user.id_user = '$id'" );
	$result = mysqli_query($con, "DELETE FROM formkajian WHERE id_kajian=$id" );
	
	if ($result) {
		echo "Berhasil Menghapus";
		echo "<script>alert('123');</script>";
		header("Location:../NewLap.php");
		}else{
		echo "Gagal Menghapus";
		}
	mysqli_close($con);
}

// end hapus User
//================================================================== end user ================================================================================

//================================================================== admin ==================================================================================
// lihat gambar bukti admin
if(isset($_POST['rowidGmbAdm'])) {

    $id = $_POST['rowidGmbAdm'];
    // mengambil data berdasarkan id
    $sql = "SELECT * FROM identitas WHERE id_identitas= $id";
    $result = mysqli_query($con,$sql);
    // $result = $koneksi->query($sql);

    if( $result ) { 
   	foreach ( $result as $data ) {
   		echo "<img src=".$data['bukti_identitas']." class='img-responsive'>";
   		// echo $data['gambar']."silit";
   	} // endforeach 
   }
}
// end lihat gambar bukti user

// tambah User
if(isset($_POST['TambahAdmin']))
{	
	$username = $_POST['username'];
	$pass = $_POST['pass'];
 	$nama = $_POST['nama'];
	$alamat = $_POST['alamat'];
	$email = $_POST['email'];
	$no_telp = $_POST['telp'];
	$no_identitas = $_POST['no_identitas'];
	
	$random = random_word(20);
	$check = getimagesize($_FILES["sgambar"]["tmp_name"]);
	$role = $admin;
	$status = $noVerifikasi;
	$token = $default;

	// encode&decode gambar
	define('UPLOAD_DIR', '../../image/bukti_identitas/');
	$gambar = base64_encode(file_get_contents( $_FILES["sgambar"]["tmp_name"] ));
    $gambar = str_replace('data:image/JPEG;base64,', '', $gambar);
    $gambar = str_replace(' ', '+', $gambar);
    $data = base64_decode($gambar);
    $gambarNama = 'IMG_ADM('.uniqid() . ').png';
    $file = UPLOAD_DIR . $gambarNama;
    $success = file_put_contents($file, $data);
    $finalImage = $server.$imageIdentitas.$gambarNama;
	// end encode&decode gambar

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
			header("Location:../ListAdmin.php");
			echo json_encode($response);
			}else{
			$response["success"] = 0;
			$response["success"] = "Gagal";
			echo json_encode($response);}
		}
	mysqli_close($con);
}

// end tambah user

// edit user
if (isset($_POST['EditAdmin'])) {
 	
 	$username = $_POST['username'];
	$password = $_POST['password'];
 	$nama = $_POST['nama'];
	$tempatlahir = $_POST['tempatlahir'];
	$tanggallahir = $_POST['tanggallahir'];
	$alamat = $_POST['alamat'];
	//$kecamatan = $_POST['kecamatan'];
	$kelurahan = $_POST['kelurahan'];
	$kecamatan = $_POST['kecamatan'];
	$uname =$_POST['uname'];//id username
	$ipeng =$_POST['ipeng'];//id pengguna
	$email = $_POST['email'];
	$sosialmedia = $_POST['sosialmedia'];
	$no_telepon = $_POST['no_telepon'];
	$no_ktp = $_POST['no_ktp'];
	$level = $_POST['level'];
	//$id_pengguna = $_POST['id_pengguna'];
	
	$random = random_word(20);
	//$check = getimagesize($_FILES["satu"]["tmp_name"]);
	//$check2 = getimagesize($_FILES["dua"]["tmp_name"]);
	$status = $noVerifikasi;
	$token = $default;

	// encode&decode gambar
	// define('UPLOAD_DIR', '../../image/foto3x4/');
	// $gambar = base64_encode(file_get_contents( $_FILES["satu"]["tmp_name"] ));
 //    $gambar = str_replace('data:image/JPEG;base64,', '', $gambar);
 //    $gambar = str_replace(' ', '+', $gambar);
 //    $data = base64_decode($gambar);
 //    $gambarNama = 'IMG_USR('.uniqid() . ').png';
 //    $file = UPLOAD_DIR . $gambarNama;
 //    $success = file_put_contents($file, $data);
 //    $finalImage = $server.$imageFoto3x4.$gambarNama;

    define('UPLOAD_DIR2', '../../image/ktp/');
	$gambar2 = base64_encode(file_get_contents( $_FILES["dua"]["tmp_name"] ));
    $gambar2 = str_replace('data:image/JPEG;base64,', '', $gambar2);
    $gambar2 = str_replace(' ', '+', $gambar2);
    $data2 = base64_decode($gambar2);
    $gambarNama2 = 'IMG_USR('.uniqid() . ').png';
    $file2 = UPLOAD_DIR2 . $gambarNama2;
    $success2 = file_put_contents($file2, $data2);
    $finalImage2 = $server.$imageKTP.$gambarNama2;
	// end encode&decode gambar

	$sql = "UPDATE pengguna SET nama='$nama', tempatlahir='$tempatlahir', tanggallahir='$tanggallahir', alamat='$alamat', kelurahan='$kelurahan',kecamatan='$kecamatan', email='$email', sosialmedia='$sosialmedia', fotoktp='$finalImage2', nomorktp='$no_ktp', no_telepon='$no_telepon' WHERE pengguna.id_pengguna = '$ipeng';";

	$sql .="UPDATE username SET username='$username', password='$password', level='$level' WHERE username.id_username = '$uname';";

	$result = mysqli_multi_query($con,$sql);

	if ($result) {
		
		$response["success"] = 1;
		$response["success"] = "Berhasil";
		$mes = "Berhasil Merubah";
		echo "<script>alert('".$mes."');window.location.href='../ListAdmin.php';</script>";
		}else{
		$response["success"] = 0;
		$response["success"] = "Gagal";
		}
	mysqli_close($con);
}
// end edit user

// hapus User
if (isset($_POST['HapusAdmin'])) {
	$id = $_GET['id'];
	// $result = mysqli_query($con, "DELETE FROM user, identitas USING user, identitas WHERE identitas.id_identitas = user.id_user AND user.id_user = '$id'" );
	$result = mysqli_query($con, "DELETE FROM user WHERE id_user=$id" );
	
	if ($result) {
		echo "Berhasil Menghapus";
		header("Location:../ListAdmin.php");
		}else{
		echo "Gagal Menghapus";
		}
	mysqli_close($con);
}

//================================================================== end admin ==============================================================================

//================================================================== Verifikasi =============================================================================


if(isset($_POST['rowidGmbVerif'])) {

    $id = $_POST['rowidGmbVerif'];
    // mengambil data berdasarkan id
    $sql = "SELECT * FROM identitas WHERE id_identitas= $id";
    $result = mysqli_query($con,$sql);
    // $result = $koneksi->query($sql);

    if( $result ) { 
   	foreach ( $result as $data ) {
   		echo "<img src=".$data['bukti_identitas']." class='img-responsive'>";
   		// echo $data['gambar']."silit";
   	} // endforeach 
   }
}

if (isset($_POST['HapusVerifikasi'])) {
	$id = $_GET['id'];
	// $result = mysqli_query($con, "DELETE FROM user, identitas USING user, identitas WHERE identitas.id_identitas = user.id_user AND user.id_user = '$id'" );
	$result = mysqli_query($con, "DELETE FROM username WHERE id_username=$id" );
	
	if ($result) {
		echo "Berhasil Menghapus";
		header("Location:../VerifikasiUser.php");
		}else{
		echo "Gagal Menghapus";
		}
	mysqli_close($con);
}

if (isset($_POST['HapusBlacklist'])) {
	$id = $_GET['id'];
	// $result = mysqli_query($con, "DELETE FROM user, identitas USING user, identitas WHERE identitas.id_identitas = user.id_user AND user.id_user = '$id'" );
	$result = mysqli_query($con, "DELETE FROM username WHERE id_username=$id" );
	
	if ($result) {
		echo "Berhasil Menghapus";
		header("Location:../BlacklistUser.php");
		}else{
		echo "Gagal Menghapus";
		}
	mysqli_close($con);
}
//================================================================== end Verifikasi =========================================================================
// fungsi random string pada gambar untuk menghindari nama file yang sama
function random_word($id = 20){
	$pool = '1234567890abcdefghijkmnpqrstuvwxyz';
	$word = '';
	for ($i = 0; $i < $id; $i++){
		$word .= substr($pool, mt_rand(0, strlen($pool) -1), 1);}
		return $word; 
	}

	

?>
