<?php 
include('../settings/koneksi.php') ;
include('service/auth.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Maps Bencana - Daftar Admin</title>

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
				<li class="active">List Admin</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">List Admin</h1>
			</div>
		</div><!--/.row-->
	
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						List User
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
					<div class="panel-body" id="map-canvas">
						<table class="table">
							<thead>
								<tr>
								<th>ID</th>
								<th>Username</th>
								<th>Password</th>
								<th>Level</th>
								<th>Status</th>
								<th>Nama Lengkap</th>
								<th>Tempat Lahir</th>
								<th>Tanggal Lahir</th>
								<th>Alamat</th>
								<th>Kelurahan</th>
								<th>Kecamatan</th>
								<th>Email</th>
								<th>Sosial Media</th>
								<th>Nomor KTP</th>
								<th>Nomor Telepon</th>
								<th>Action</th>
							</tr>
						</thead>
						<?php 
						//$admin = $admin;
						//$verifikasi = $verifikasi;
						$query = mysqli_query($con,"SELECT id_username, username, password, status,level,pengguna.id_pengguna, nama, tempatlahir, tanggallahir, alamat, kelurahan, kecamatan, email, sosialmedia, fotoktp, nomorktp,no_telepon FROM username JOIN pengguna ON username.id_pengguna = pengguna.id_pengguna where status='Verifikasi' && level='Admin'"); while ($data = mysqli_fetch_array($query))
						{
						$id = $data['id_username'];
						$username = $data['username'];
						$password = $data['password'];
						$status = $data['status'];
						$level = $data['level'];
						$id_pengguna = $data['id_pengguna'];
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

						echo ("
							<tbody>
							<tr>
							<td>$id</td>
							<td>$username</td>
							<td>$password</td>
							<td>$level</td>
							<td>$status</td>
							<td>$nama</td>
							<td>$tempatlahir</td>
							<td>$tanggallahir</td>
							<td>$alamat</td>
							<td>$kelurahan</td>
							<td>$kecamatan</td>
							<td>$email</td>
							<td>$sosialmedia</td>
							<td>$no_ktp</td>
							<td>$no_telepon</td>
							<td><button id='gambar' type='button' class='btn btn-md btn-default' data-toggle='modal' data-target='#sGambarUsr' data-id='$id_pengguna'>Foto KTP</button>
							<td><form action='EditAdmin.php?id=$id' method='post'>
								<button id='LihatKajian' type='submit' class='btn btn-md btn-warning' name='LihatUser'>Edit</button></form></td>
							<td><form action='service/function.php?id=$id' method='post'>
								<button id='BlokirAdmin' type='submit' class='btn btn-md btn-warning' name='BlokirAdmin' onclick='blockData($id)'>Blokir</button></form></td>
							<td><form action='service/function.php?id=$id' method='post'>
								<button id='HapusAdmin' type='submit' class='btn btn-md btn-danger' name='HapusAdmin' value='$id' onclick='deleteData($id)'>Hapus</button></form></td> ");                 
            }
          ?>

							</tr>
						</tbody>
					</table>
						<!-- modal show gambar / mau nambah -->
						<div id='sGambarUsr' class='modal fade' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
							<div class='modal-dialog'>
								<div class='modal-content'>
									<div class='modal-body'>
										<!-- <p>dancok $gambar</p> -->
										<div class="fetched-data"></div>
									</div>
								</div>
							</div>
						</div>
						<!-- end modal show gambar-->

						<!-- <div id='sGambarUsr2' class='modal fade' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
							<div class='modal-dialog'>
								<div class='modal-content'>
									<div class='modal-body'> -->
										<!-- <p>dancok $gambar</p> -->
										<!-- <div class="fetched-data"></div>
									</div>
								</div>
							</div>
						</div> -->
						<!-- end modal show gambar-->

					</div>
				</div>
			</div>
		</div><!--/.row-->
		
<?php include('footer.php') ?>

<!-- script modal image  -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#sGambarUsr').on('show.bs.modal', function (e) {
            var rowidGmbUsr = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : 'service/function.php',
                data :  'rowidGmbUsr='+ rowidGmbUsr,
                success : function(data){
                $('.fetched-data').html(data);//menampilkan data ke dalam modal
                }
            });
         });
    });
  </script>
<!-- end script modal image -->

<!-- <script type="text/javascript">
    $(document).ready(function(){
        $('#sGambarUsr2').on('show.bs.modal', function (e) {
            var rowidGmbUsr = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : 'service/function.php',
                data :  'rowidGmbUsr2='+ rowidGmbUsr,
                success : function(data){
                $('.fetched-data').html(data);//menampilkan data ke dalam modal
                }
            });
         });
    });
  </script> -->
<!-- end script modal image -->

<!-- edit view list -->
<script type="text/javascript">
function viewEdit(x){
	window.location = "service/EditUser.php?id="+x;
}
</script>
<!-- end edit view list -->

<script type="text/javascript">
function blockData(x){
  if (!confirm('Apakah Anda Yakin?')) {
    event.preventDefault();
  }
}
</script>

<!-- delete script  -->
<script type="text/javascript">
function deleteData(x){
  if (!confirm('Delete?')) {
    event.preventDefault();
  }
}
</script>
<!-- end delete script-->

</body>
</html>