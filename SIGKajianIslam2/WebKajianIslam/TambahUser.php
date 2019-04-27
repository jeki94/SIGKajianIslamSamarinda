<?php 
include('../settings/koneksi.php') ;
//include('service/auth.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Kajian Islam Samarinda - Tambah User</title>

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
				<li class="active">Tambah User</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Tambah User</h1>
			</div>
		</div><!--/.row-->
	
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						Tambah User
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
						<div class="panel-body">

						<div class="col-md-6">

							<form role="form" method="post" action="service/function.php" enctype="multipart/form-data">
									<div class="form-group">
									<label>Username</label>
									<input class="form-control" placeholder="Username" name="username" required>
									</div>

									<div class="form-group">
									<label>Password</label>
									<input type="Password" class="form-control" placeholder="Password" name="password" required>
									</div>

									<div class="form-group">
										<label>Level</label>
										<select id="level" class="form-control" name="level" required>
											<option disabled value="" selected hidden>Pilih Level</option>
											<option value= 'Admin' nama = 'Admin'>Admin</option>
											<option value= 'User' nama = 'User'>User</option>

											</select>
									</div>


									<div class="form-group">
									<label>Nama Lengkap</label>
									<input class="form-control" placeholder="Nama Lengkap" name="nama" required>
									</div>

									<div class="form-group">
									<label>Tempat Lahir</label>
									<input class="form-control" placeholder="Tempat Lahir" name="tempatlahir" required>
									</div>

									<div class="form-group">
									<label>Tanggal Lahir</label>
									<input type="date" class="form-control" placeholder="Tanggal Lahir" name="tanggallahir" required>
									</div>

									<div class="form-group">
									<label>Alamat</label>
									<input class="form-control" placeholder="Alamat" name="alamat" required>
									</div>

									<div class="form-group">
									<label>Kelurahan</label>
									<input class="form-control" placeholder="Kelurahan" name="kelurahan" required>
									</div>

									<div class="form-group">
									<label>Kecamatan</label>
									<input class="form-control" placeholder="Kecamatan" name="kecamatan" required>
									</div>

									<div class="form-group">
									<label>E-Mail</label>
									<input class="form-control" placeholder="E-Mail" name="email" required>
									</div>

									<div class="form-group">
									<label>Sosial Media</label>
									<input class="form-control" placeholder="Sosial Media" name="sosialmedia" required>
									</div>

									<!-- <div class="form-group">
									<label>Foto Diri 3x4</label>
									<input type="file" id="foto3x4" name="satu" required>
									<p class="help-block">Silahkan Upload Foto diri 3x4.</p>
									</div> -->

									<div class="form-group">
									<label>Foto KTP</label>
									<input type="file" id="fotoktp" name="dua" required>
									<p class="help-block">Silahkan Upload Foto/Scan KTP.</p>
									</div>

									<div class="form-group">
									<label>No. KTP</label>
									<input class="form-control" placeholder="No. KTP" name="no_ktp" required>
									</div>

									<div class="form-group">
									<label>No. Telepon</label>
									<input class="form-control" placeholder="No. Telepon" name="no_telepon" required>
									</div>

									<button type="submit" class="btn btn-primary" name="TambahUser" onclick="return(validate());">Submit Button</button>
									<button type="reset" class="btn btn-default">Reset Button</button>

								</div>
									<!-- <div class="form-group">
									<label id="nmaGmbr">Preview Gambar Foto 3x4</label><br>
									<img id="srcGmb2" width="300"/> -->
									<!-- <div class="panel-body" id="map" style="height: 500px;"></div> -->
									

									<!-- </div> -->

									<div class="form-group">
									<label id="nmaGmbr2">Preview Gambar Foto KTP</label><br>
									<img id="srcGmb" width="300"/>
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


$("#fotoktp").change(function(){
    // 
    var a = (this.files[0].size);

    if(a > 2000000){
    	alert('Ukuran Gambar Melebihi 2 MB');
    }else{
    	readURL(this);
    }
    

});
</script>



<!-- end image view -->

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