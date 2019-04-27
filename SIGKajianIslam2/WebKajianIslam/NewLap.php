<?php 
include('../settings/koneksi.php') ;
include('service/auth.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Riwayat Kajian Islam Kota Samarinda</title>

</head>
<body>
	<?php include('header.php') ?>
	<?php include('sidebar.php') ?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Riwayat Kajian</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Riwayat Kajian</h1>
			</div>
		</div><!--/.row-->
	
	<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						Riwayat Kajian
						<ul class="pull-right panel-settings panel-button-tab-right">
							<li class="dropdown"><a class="pull-right dropdown-toggle" data-toggle="dropdown" href="#">
								<em class="fa fa-cogs"></em>
							</a>
								<ul class="dropdown-menu dropdown-menu-right">
									<li>
										<ul class="dropdown-settings">
										</ul>
									</li>
								</ul>
							</li>
						</ul>
						
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>


						<!-- dropdown -->
						<center>
						<select id="bulan" name="perbulan" onchange="dashboard()">  
							<?php echo "<option value='-'>-</option>"; ?>
							<!-- SELECT DISTINCT MONTH(tgl) FROM bencana ORDER BY tgl DESC -->
						<?php $query = mysqli_query($con,"SELECT DISTINCT DATE_FORMAT(tanggalkajian,'%m') AS bulan FROM formkajian Where statuskajian='TelahSelesai' ORDER BY tanggalkajian DESC"); while ($data = mysqli_fetch_array($query))
						{	
							$bulan = $data['bulan'];
							
							echo "<option value='" . $bulan . "'>" . $bulan . "</option>";
							echo "<script>console.log( 'bulan: " . $bulan . "' );</script>";
						}?> 						                     
						</select>

						<select id="tahun" name="pertahun" onchange="dashboard()">  
							<?php echo "<option value='-'>-</option>"; ?>
						<?php $query = mysqli_query($con,"SELECT DISTINCT YEAR(tanggalkajian) FROM formkajian ORDER BY tanggalkajian DESC"); while ($data = mysqli_fetch_array($query))
						{	
							$tahun = $data['YEAR(tanggalkajian)'];
							echo "<option value='" . $tahun . "'>" . $tahun . "</option>";
						}?>                      
						</select>

						<button id="download" type="button" class="btn btn-sm btn-success" onclick="sendPDF()">Download</button>
						</center>

						<!-- end dropdown -->

						<!-- dari sini -->
						<div id="table_content" class="table-responsive" style="margin: 5px;">
							<table class="table">
							<thead>
								<tr>
								<th>ID Kajian</th>
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

								<th>Action</th>
							</tr>
						</thead>

							<?php $query = mysqli_query($con,"SELECT id_kajian,namakajian,namapemateri,namatempat,lat,lng,alamat,kelurahan,kecamatan,tanggalkajian,waktumulai,waktuselesai,kuota,statuspeserta,statusberbayar,pengelola,kontakpengelola,informasi, username.username FROM formkajian JOIN username ON formkajian.id_username = username.id_username WHERE formkajian.statuskajian='TelahSelesai' ORDER BY id_kajian && MONTH(tanggalkajian) = MONTH(CURRENT_DATE) DESC "); while ($data = mysqli_fetch_array($query))
						{
						$id = $data['id_kajian'];
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

						// <img src=$gambar class='img-responsive'>

						echo ("
							<tbody >
							<tr>
							<td>$id</td>
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
							<td>$author</td>
							<td><form action='service/function.php?id=$id' method='post'>
								<button id='HapusLaporan' type='submit' class='btn btn-md btn-danger' name='HapusLaporan' value'$id' onclick='deleteData($id)'>Hapus</button></form></td>");                 
            }
          ?>

						</tbody>
					</table>
					</div>
						<!-- sampe sini -->

						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->		
		
<?php include('footer.php') ?>

<!-- baru -->
<script>
function dashboard() {

tahun = document.getElementById("tahun").value;
bulan = document.getElementById("bulan").value;
console.log(tahun);
console.log(bulan);

var dataString = 'tahun=' + tahun + '&bulan=' + bulan;

// AJAX code to execute query and get back to same page with table content without reloading the page.
$.ajax({
type: "POST",
url: "service/function.php",
data: dataString,
cache: false,
success: function(html) {
// alert(dataString);
document.getElementById("table_content").innerHTML=html;
}
});
return false;


}

</script>

<script>
function sendPDF() {
tahun = document.getElementById("tahun").value;
bulan = document.getElementById("bulan").value;
console.log(tahun);
console.log(bulan);
if (bulan === "-") {
	alertDownload();
}else if(tahun ==="-"){
	alertDownload();
}else{

var dataString = 'tahun=' + tahun + '&bulan=' + bulan;

// AJAX code to execute query and get back to same page with table content without reloading the page.
$.ajax({
type: "POST",
// url: "pdf.php",
url:"pdf.php?tahun="+tahun+"&bulan="+bulan,
data: dataString,
cache: false,
success: function(html) {

       window.location = "pdf.php?tahun="+tahun+"&bulan="+bulan;
}
});
}

return false;


}

</script>

<script type="text/javascript">

function alertDownload() {

  var bulan = document.getElementById("bulan").value;
  var tahun = document.getElementById("tahun").value;
  alert("Silahkan Pilih Bulan Dan Tanggal Terlebih Dahulu");

} 
</script>

<script type="text/javascript">
function deleteData(x){
  if (!confirm('Delete?')) {
    event.preventDefault();
  }
}
</script>

<!-- end baru -->
</body>
</html>