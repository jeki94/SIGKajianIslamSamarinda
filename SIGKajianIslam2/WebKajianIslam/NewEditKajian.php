<?php 
include('../settings/koneksi.php') ;

$id = $_GET['id'];
$result = mysqli_query($con, "SELECT * FROM formkajian WHERE id_kajian=$id");

while($data = mysqli_fetch_array($result))
{
	$namakajian = $data['namakajian'];
	$namapemateri = $data['namapemateri'];
	$namatempat = $data['namatempat'];
	$latitude = $data['lat'];
	$longtitude = $data['lng'];
	$fotoposter = $data['fotoposter'];
	$fototempat = $data['fototempat'];
	$alamat = $data['alamat'];
	$kelurahan = $data['kelurahan'];
	$kecamatan = $data['kecamatan'];
	$tanggalkajian = $data['tanggalkajian'];
	$waktumulai = $data['waktumulai'];
	$waktuselesai = $data['waktuselesai'];
	$kuota = $data['kuota'];
	$statuspeserta = $data['statuspeserta'];
	//$statuskajian = $data['statuskajian'];
	$statusberbayar = $data['statusberbayar'];
	$pengelola = $data['Pengelola'];
	$kontakpengelola = $data['kontakpengelola'];
	$informasi = $data['informasi'];
	$finformasi= str_replace("/", "'", $informasi);

}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Maps Kajian - Edit Kajian</title>
<!-- 	<script async defer src=<?php echo $api_google; ?>></script> -->
	<style type="text/css">#map-canvas {height: 450px;width: 100%;}</style>
	<link rel="stylesheet" type="text/css" href="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.css" />
    <script type='text/javascript' src='http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.js'></script>
    <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js'></script>


</head>
<body>
	<?php include('header.php') ?>
	<?php include('sidebar.php') ?>
    <?php include('service/NotifService.php') ?>		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Edit Kajian</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Edit Kajian</h1>
			</div>
		</div><!--/.row-->
	
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						Edit Kajian
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
						<div class="panel-body">

						<div class="col-md-6">
							<form role="form" method="post" action="service/function.php?id=<?php echo $id ?>"enctype="multipart/form-data">
								<div class="form-group">
									<input class="form-control" placeholder="idkajian" name="idkajian" type="hidden" value="<?php echo $id ?>">
								</div>
									<div class="form-group">
									<label>Nama Kajian</label>
									<input class="form-control" placeholder="Nama Kajian" name="namakajian" required value="<?php echo $namakajian;?>">
									</div>
									<div class="form-group">
									<label>Nama Pemateri</label>
									<input class="form-control" placeholder="Nama Pemateri" name="namapemateri" required value="<?php echo $namapemateri;?>">
									</div>
									<div class="form-group">
									<label>Nama Tempat Kajian</label>
									<input class="form-control" placeholder="Tempat Kajian" name="tempatkajian" required value="<?php echo $namatempat;?>">
									</div>
									<div class="form-group" >
									<label>Pilih Lokasi Kajian</label>
									<input type="button" id="mapInp" name="mapInp" value="Pilih Lokasi Kejadian" data-toggle="modal">

									<p>Latitude : <input type="text" id="lat-data" name="latitude" style="border:none" value=<?php echo $latitude;?> readonly></p>
									<p>Longtitude: <input type="text" id="lng-data" name="longtitude" style="border:none" value=<?php echo $longtitude;?> readonly></p>
									<!-- Modal -->
									<div class="modal fade" id="modal" role="dialog">
										<div class="modal-dialog">
											<!-- Modal content-->
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">Lokasi Kajian</h4>
												</div>
												<div class="modal-body">
													<div class="panel-body" id="map-canvas" ></div>
												</div>
												<div class="modal-footer">
													<!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
													<button type="button" data-dismiss="modal" class="btn btn-primary" data-value="1">Continue</button>
												</div>
											</div>
										</div>
									</div>
									<!-- end modal -->
									</div>
									<div class="form-group">
									<label>Gambar Publikasi Kajian</label>
									<input type="file" id="gambarpublikasikajian" name="satu">
									<p class="help-block">Pilih Gambar Dari Gallery.</p>
									</div>
									<div class="form-group">
									<label>Foto Tempat Kajian</label>
									<input type="file" id="gambartempatkajian" name="dua">
									<p class="help-block">Pilih Gambar Dari Gallery.</p>
									</div>
									<div class="form-group">
									<label>Alamat</label>
									<input class="form-control" placeholder="alamat" name="alamat" value="<?php echo $alamat;?>">
									</div>

									<div class="form-group">
									<label>Kelurahan</label>
									<input class="form-control" placeholder="Kelurahan" name="kelurahan" value="<?php echo $kelurahan;?>">
									</div>

									<div class="form-group">
									<label>Kecamatan</label>
									<input class="form-control" placeholder="Kecamatan" name="kecamatan" value="<?php echo $kecamatan;?>">
									</div>

									<div>
									<label>Tanggal Kajian</label>
									<input type="date" class="form-control" placeholder="Tanggal Kajian" name="tanggalkajian" value="<?php echo $tanggalkajian;?>">
									</div>
									<div class="form-group">
									<label>Waktu Mulai</label>
									<input class="form-control" placeholder="Waktu Mulai" name="waktumulai" value="<?php echo $waktumulai;?>">
									</div>
									<div class="form-group">
									<label>Waktu Selesai</label>
									<input class="form-control" placeholder="Waktu Selesai" name="waktuselesai" value="<?php echo $waktuselesai;?>">
									</div>
									<div class="form-group">
									<label>Kuota Peserta</label>
									<input class="form-control" placeholder="Kuota Peserta" name="kuotapeserta" value="<?php echo $kuota;?>">
									</div>
									<div class="form-group">
									<label>Status Peserta</label>
									<input class="form-control" placeholder="Laki-Laki/Perempuan/Umum" name="statuspeserta" value="<?php echo $statuspeserta;?>">
									</div>
									<div class="form-group">
									<input type="hidden" class="form-control" name="statuskajian" value="Aktif">
									</div>
									<!-- <!-- <div class="form-group">
										<label>Status Kajian</label>
										<select id="level" class="form-control" name="statuskajian" required>
											<?php if ($statuskajian==="Aktif"){
												echo "<option value="."Aktif".">Aktif</option>";
												echo "<option value='"."Telah Berlalu"."''>Telah Berlalu</option>";
											}
												else{
												echo "<option value='"."Telah Berlalu"."'>Telah Berlalu</option>";
												echo "<option value="."Aktif".">Aktif</option>";
												}
											 ?>
												<!-- <option value="<?php echo $level;  ?>"> <?php echo $level; ?></option> -->
											

											<!-- </select>
									</div> --> 

									<!-- <div class="form-group">
										<label>Status Kajian</label>
										<select class="form-control" name="statuskajian" required value="<?php echo $statuskajian;?>">
											<option disabled value="" selected hidden>Pilih Status</option>
											<option value="Aktif">Aktif</option>
											<option value="Telah_Berlalu">Telah Berlalu</option>
										</select>
									</div> -->
									<div class="form-group">
									<label>Status Berbayar</label>
									<input class="form-control" placeholder="Berbayar Rp...../Gratis" name="statusberbayar" value="<?php echo $statusberbayar;?>">
									</div>
									<div class="form-group">
									<label>Pengelola</label>
									<input class="form-control" placeholder="Pengelola" name="pengelola" value="<?php echo $pengelola;?>">
									</div>
									<div class="form-group">
									<label>No. Telepon Pengelola</label>
									<input class="form-control" placeholder="No. Telp Pengelola" name="kontakpengelola" value="<?php echo $kontakpengelola;?>">
									</div>
									<div class="form-group">
									<label>Informasi</label>
									<input class="form-control" placeholder="Informasi" name="informasi" value="<?php echo $finformasi;?>">
									</div>
									<div class="form-group">
									<input class="form-control" placeholder="Keterangan" name="username" value="<?php echo $_SESSION['username']; ?>" style="display: none;">
									</div>
									<button type="submit" class="btn btn-primary" name="EditKajian" onclick="return(validate());">Submit Button</button>
									<button type="reset" class="btn btn-default">Reset Button</button>
								</div>
									<div class="form-group">
									<label id="nmaGmbr">Preview Gambar Publikasi</label>
									<br/>
									<img id="srcGmb" width="300" src="<?php echo $fotoposter; ?>"/>
									<!-- <div class="panel-body" id="map" style="height: 500px;"></div> -->
									

									</div>
									<div class="form-group">
									<label id="nmaGmbr2">Preview Foto Tempat</label>
									<br/>
									<img id="srcGmb2" width="300" src="<?php echo $fototempat; ?>"/>
									<!-- <div class="panel-body" id="map" style="height: 500px;"></div> -->
									

									</div>
							</form>
						</div>
						
						<!-- kalo mau nambah -->
						</div>
				</div>
			</div>
		</div><!--/.row-->
		
<?php include('footer.php') ?>

<!-- image view -->
<script type="text/javascript">
	function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#srcGmb').attr('src', e.target.result);

        }

        reader.readAsDataURL(input.files[0]);

    }
}


$("#gambarpublikasikajian").change(function(){
    // 
    var a = (this.files[0].size);

    if(a > 2000000){
    	alert('Ukuran Gambar Melebihi 2 MB');
    }else{
    	readURL(this);
    }
    

});
</script>

<script type="text/javascript">
	function readURL2(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#srcGmb2').attr('src', e.target.result);

        }

        reader.readAsDataURL(input.files[0]);

    }
}


$("#gambartempatkajian").change(function(){
    var a = (this.files[0].size);

    if(a > 2000000){
    	alert('Ukuran Gambar Melebihi 2 MB');
    }else{
    	readURL2(this);
    }

});

</script>

<!-- end image view -->

<!-- modal function -->
<script type="text/javascript">


$("#modal").modal('show');
$(document).on('click', '#mapInp', function(){
    $("#modal").modal('show');
})

</script>

<!-- end modal function -->

<!-- start maps function -->

    <script>
	var map = L.map( 'map-canvas', {
		center: [ -0.49841,117.14245],
		minZoom: 2,
		zoom: 14
	})

	L.tileLayer( 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
		subdomains: ['a', 'b', 'c']
	}).addTo(map)
	theMarker = new L.marker( [<?php echo "$latitude"; ?>, <?php echo "$longtitude"; ?>]).addTo( map );

	// start marker
	var theMarker = {}
	map.on('click',function(e){
		lat = e.latlng.lat;
		lon = e.latlng.lng;
		console.log("You clicked the map at LAT: "+ lat+" and LONG: "+lon );
		document.getElementById("lat-data").value = lat;
        document.getElementById("lng-data").value = lon;

		//Clear existing marker, 

		if (theMarker != undefined) {
			map.removeLayer(theMarker);
		}

		//Add a marker to show where you clicked.

		theMarker = L.marker([lat,lon]).addTo(map);  

	});

	// marker end

    </script>
<!-- end maps -->

<!-- sementara -->
<script type="text/javascript">
$("#modal").modal('show');
$(document).on('click', '#mapInp', function(){
    $("#modal").modal('show');
})
</script>
<!-- end sementara -->

<script type="text/javascript">
	function validate(){
		if(document.getElementById('lng-data')&&document.getElementById('lat-data').value=='-')
        {
        alert('Silahkan Pilih Lokasi Terlebih Dahulu');
        document.getElementById("mapInp").style.borderColor="#30a5ff";
        // document.getElementById("fname").style.backgroundColor="yellow";
        // document.getElementById("fname").style.borderWidth=2;
        return false;
        }else if (document.getElementById('lng-data')&&document.getElementById('lat-data').value!='')
        {
		document.getElementById("mapInp").style.borderColor="inherit";
        }
	}
</script>

</body>
</html>