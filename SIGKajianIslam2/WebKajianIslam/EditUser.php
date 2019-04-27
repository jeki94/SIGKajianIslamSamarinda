<?php 
include('../settings/koneksi.php') ;

$id = $_GET['id'];

$result = mysqli_query($con, "SELECT id_username, username, password, status,level, nama, tempatlahir, tanggallahir, alamat, kelurahan,kecamatan, email, sosialmedia, fotoktp, nomorktp,no_telepon, username.id_pengguna FROM username JOIN pengguna ON username.id_pengguna = pengguna.id_pengguna WHERE id_username =$id");

while($data = mysqli_fetch_array($result))
{
	$username = $data['username'];
	$password = $data['password'];
	$status = $data['status'];
	$level = $data['level'];
	$nama = $data['nama'];
	$tempatlahir = $data['tempatlahir'];
	$tanggallahir = $data['tanggallahir'];
	$alamat = $data['alamat'];
	$kelurahan = $data['kelurahan'];
	$kecamatan = $data['kecamatan'];
	$email = $data['email'];
	$sosialmedia = $data['sosialmedia'];
	$fotoktp = $data['fotoktp'];
	$no_ktp = $data['nomorktp'];
	$no_telepon = $data['no_telepon'];
	$id_peng = $data['id_pengguna'];
	$level = $data['level'];
	

}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Maps Bencana - User</title>

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
				<li class="active">Edit User</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Edit User</h1>
			</div>
		</div><!--/.row-->
	
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						Edit User
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
						<div class="panel-body">

						<div class="col-md-6">

							<form role="form" method="post" action="service/function.php?id=<?php echo $id ?>" enctype="multipart/form-data">
									<div class="form-group">
									<input class="form-control" placeholder="Username" name="uname" type="hidden" value=<?php echo $id ?>>
									</div>
									<div class="form-group">
									<input class="form-control" placeholder="Username" name="ipeng" type="hidden" value="<?php echo $id_peng ?>">
									</div>
									<div class="form-group">
									<label>Username</label>
									<input class="form-control" placeholder="Username" name="username" required value="<?php echo $username;?>">
									</div>

									<div class="form-group">
									<label>Password</label>
									<input type="Password" class="form-control" placeholder="Password" name="password" required value="<?php echo $password;?>">
									</div>

									<div class="form-group">
										<label>Level</label>
										<select id="level" class="form-control" name="level" required>
											<?php if ($level==="Admin"){
												echo "<option value="."Admin".">admin</option>";
												echo "<option value="."User".">user</option>";
											}
												else{
												echo "<option value="."User".">user</option>";
												echo "<option value="."Admin".">admin</option>";
												}
											 ?>
												<!-- <option value="<?php echo $level;  ?>"> <?php echo $level; ?></option> -->
											

											</select>
									</div>

									<div class="form-group">
									<label>Nama Lengkap</label>
									<input class="form-control" placeholder="Nama Lengkap" name="nama" required value="<?php echo $nama;?>">
									</div>

									<div class="form-group">
									<label>Tempat Lahir</label>
									<input class="form-control" placeholder="Tempat Lahir" name="tempatlahir" required value="<?php echo $tempatlahir;?>">
									</div>

									<div class="form-group">
									<label>Tanggal Lahir</label>
									<input type="date" class="form-control" placeholder="Tanggal Lahir" name="tanggallahir" required value="<?php echo $tanggallahir;?>">
									</div>

									<div class="form-group">
									<label>Alamat</label>
									<input class="form-control" placeholder="Alamat" name="alamat" required value="<?php echo $alamat;?>">
									</div>

									<div class="form-group">
									<label>Kelurahan</label>
									<input class="form-control" placeholder="Kelurahan" name="kelurahan" required value="<?php echo $kelurahan;?>">
									</div>

									<div class="form-group">
									<label>Kecamatan</label>
									<input class="form-control" placeholder="Kecamatan" name="kecamatan" required value="<?php echo $kecamatan;?>">
									</div>
									
									<div class="form-group">
									<label>E-Mail</label>
									<input class="form-control" placeholder="E-Mail" name="email" required value="<?php echo $email;?>">
									</div>

									<div class="form-group">
									<label>Sosial Media</label>
									<input class="form-control" placeholder="Sosial Media" name="sosialmedia" required value="<?php echo $sosialmedia;?>">
									</div>

									<!-- <div class="form-group">
									<label>Foto Diri 3x4</label>
									<input type="file" id="foto3x4" name="satu" required>
									<p class="help-block">Silahkan Upload Foto diri 3x4.</p>
									</div> -->

									<div class="form-group">
									<label>Foto KTP</label>
									<input type="file" id="fotoktp" name="dua">
									<p class="help-block">Silahkan Upload Foto/Scan KTP.</p>
									</div>

									<div class="form-group">
									<label>No. KTP</label>
									<input class="form-control" placeholder="No. KTP" name="no_ktp" required value="<?php echo $no_ktp;?>">
									</div>

									<div class="form-group">
									<label>No. Telepon</label>
									<input class="form-control" placeholder="No. Telepon" name="no_telepon" required value="<?php echo $no_telepon;?>">
									</div>

									<button type="submit" class="btn btn-primary" name="EditUser" onclick="return(validate());">Submit Button</button>
									<button type="reset" class="btn btn-default">Reset Button</button>

								</div>
									<!-- <div class="form-group">
									<label id="nmaGmbr">Preview Gambar Foto 3x4</label><br>
									<img id="srcGmb2" width="300" src="<?php //echo $foto3x4; ?>" /> -->
									<!-- <div class="panel-body" id="map" style="height: 500px;"></div> -->
									

									<!-- </div> -->

									<div class="form-group">
									<label id="nmaGmbr2">Preview Gambar Foto KTP</label><br>
									<img id="srcGmb" width="300" src="<?php echo $fotoktp; ?>"/>
									<!-- <div class="panel-body" id="map" style="height: 500px;"></div> -->
									

									</div>
							</form>
						</div>
						
						<!-- kalo mau nambah -->
						</div>
				</div>
			</div>
		</div>
		
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


</body>
</html>