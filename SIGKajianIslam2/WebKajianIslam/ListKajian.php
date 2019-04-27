<?php 
include('../settings/koneksi.php') ;
//include('service/auth.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Kajian Islam Samarinda - Daftar Kajian</title>

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
				<li class="active">List Kajian</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">List Kajian</h1>
			</div>
		</div><!--/.row-->
	
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						List Kajian
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
					<div class="panel-body" id="map-canvas">
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
								<th>Status Kajian</th>
								<th>Status Berbayar</th>
								<th>Pengelola</th>
								<th>Kontak Pengelola</th>
								<th>Informasi</th>
								<th>Publisher</th>


								<th>Action</th>
							</tr>
						</thead>
						<?php 
						//$aktif = $aktif;
						$query = mysqli_query($con,"SELECT id_kajian ,namakajian,namapemateri,namatempat,lat,lng,alamat,kelurahan,kecamatan,tanggalkajian,waktumulai,waktuselesai,kuota,statuspeserta,statuskajian,statusberbayar,pengelola,kontakpengelola,informasi, username.username FROM formkajian JOIN username ON formkajian.id_username = username.id_username WHERE formkajian.statuskajian='aktif' ORDER BY id_kajian DESC  "); while ($data = mysqli_fetch_array($query))
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
						$statuskajian = $data['statuskajian'];
						$statusberbayar = $data['statusberbayar'];
						$pengelola = $data['pengelola'];
						$kontakpengelola = $data['kontakpengelola'];
						$informasi = $data['informasi'];
						$finformasi= str_replace("/", "'", $informasi);
						$author = $data['username'];

						// <img src=$gambar class='img-responsive'>

						echo ("
							<tbody>
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
							<td>$statuskajian</td>
							<td>$statusberbayar</td>
							<td>$pengelola</td>
							<td>$kontakpengelola</td>
							<td>$finformasi</td>
							<td>$author</td>
							<td><button id='gambar' type='button' class='btn btn-md btn-default' data-toggle='modal' data-target='#sGambar' data-id='$id'>Gambar Tempat</button></td>
							<td><button id='gambar' type='button' class='btn btn-md btn-default' data-toggle='modal' data-target='#sGambar2' data-id='$id'>Gambar Poster</button></td>
							<td><form action='newEditKajian.php?id=$id' method='post'>
								<button id='LihatKajian' type='submit' class='btn btn-md btn-warning' name='LihatKajian'>Edit</button></form></td>
							<td><form action='service/function.php?id=$id' method='post'>
								<button id='StatusKajian' type='submit' class='btn btn-md btn-warning' name='StatusKajian' onclick='verifData($id)'>Telah Selesai</button></form></td>
							<td><form action='service/function.php?id=$id' method='post'>
								<button id='HapusKajian' type='submit' class='btn btn-md btn-danger' name='HapusKajian' value'$id' onclick='deleteData($id)'>Hapus</button></form></td> ");                 
            }
          ?>

							</tr>
						</tbody>
					</table>
						<!-- modal show gambar / mau nambah -->
						<div id='sGambar' class='modal fade' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
							<div class='modal-dialog'>
								<div class='modal-content'>
									<div class='modal-body'>
										<!-- <p>dancok $gambar</p> -->
										<div class="fetched-data"></div>
									</div>
								</div>
							</div>
						</div>

						<div id='sGambar2' class='modal fade' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
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

					</div>
				</div>
			</div>
		</div><!--/.row-->
		
<?php include('footer.php') ?>

<!-- script modal image  -->
 <script type="text/javascript">
    $(document).ready(function(){
        $('#sGambar').on('show.bs.modal', function (e) {
            var rowidGmb = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : 'service/function.php',
                data :  'rowidGmb='+ rowidGmb,
                success : function(data){
                $('.fetched-data').html(data);//menampilkan data ke dalam modal
                }
            });
         });
    });
  </script>

   <script type="text/javascript">
    $(document).ready(function(){
        $('#sGambar2').on('show.bs.modal', function (e) {
            var rowidGmb = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : 'service/function.php',
                data :  'rowidGmb2='+ rowidGmb,
                success : function(data){
                $('.fetched-data').html(data);//menampilkan data ke dalam modal
                }
            });
         });
    });
  </script>
<!-- end script modal image -->

<!-- edit view list -->
<script type="text/javascript">
function viewEdit(x){
	window.location = "service/EditBencana.php?id="+x;
}
</script>
<!-- end edit view list -->

<script type="text/javascript">
function verifData(x){
  if (!confirm('Apakah Anda yakin?')) {
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