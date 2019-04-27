<?php 
$directoryURI = $_SERVER['REQUEST_URI'];
$path = parse_url($directoryURI, PHP_URL_PATH);
$components = explode('/', $path);
$part = basename($_SERVER['PHP_SELF'], ".php");

if(!isset($_SESSION)){
	session_start();
}  

// echo $part;
?>
<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div class="profile-sidebar">
			<div class="profile-userpic">
				<img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">
			</div>
			<div class="profile-usertitle">
				<div class="profile-usertitle-name"><?php echo $_SESSION['username']; ?></div>
				<div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="divider"></div>
		<ul class="nav menu">
			<li class="<?php if ($part=="dashboard") {echo "active"; } else  {echo "noactive";}?>"><a href="NewDashboard.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
			<li class="<?php if ($part=="") {echo "active"; } else  {echo "noactive";}?>"><a href="VerifikasiUser.php"><em class="fa fa-calendar">&nbsp;</em> Verifikasi User</a></li>
			<li class="<?php if ($part=="DaftarBencana") {echo "active"; } else  {echo "noactive";}?>"><a href="ListKajian.php"><em class="fa fa-bar-chart">&nbsp;</em> Daftar Kajian</a></li>
<!-- 			<li class="<?php if ($part=="") {echo "active"; } else  {echo "noactive";}?>"><a href="#"><em class="fa fa-toggle-off">&nbsp;</em> UI Elements</a></li>	 -->		
<li class="<?php if ($part=="") {echo "active"; } else  {echo "noactive";}?>"><a href="newlap.php"><em class="fa fa-toggle-off">&nbsp;</em> Riwayat Kajian</a></li>
			<li class="<?php if ($part=="") {echo "active"; } else  {echo "noactive";}?>"><a href="service/PushNotification.php"><em class="fa fa-clone">&nbsp;</em> Push Notification</a></li>
			<!-- bencana -->
			<li class="parent "><a data-toggle="collapse" href="#sub-item-1">
				<em class="fa fa-navicon">&nbsp;</em> Mgmt Kajian <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-1">
					<li><a class="" href="ListKajian.php">
						<span class="fa fa-arrow-right">&nbsp;</span> List Kajian
					</a></li>
					<li><a class="" href="NewTambahKajian.php">
						<span class="fa fa-arrow-right">&nbsp;</span> Tambah Kajian
					</a></li>
				</ul>
			</li>
			<!-- end bencana -->
			<!-- admin -->
	
			<!-- end admin -->
			<!-- user -->
			<li class="parent "><a data-toggle="collapse" href="#sub-item-3">
				<em class="fa fa-navicon">&nbsp;</em> Mgmt User <span data-toggle="collapse" href="#sub-item-3" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-3">
					<li><a class="" href="ListUser.php">
						<span class="fa fa-arrow-right">&nbsp;</span> List Pengguna
					</a></li>
					<li><a class="" href="ListAdmin.php">
						<span class="fa fa-arrow-right">&nbsp;</span> List Admin
					</a></li>
					<li><a class="" href="BlacklistUser.php">
						<span class="fa fa-arrow-right">&nbsp;</span> List Blacklist
					</a></li>
					<li><a class="" href="TambahUser.php">
						<span class="fa fa-arrow-right">&nbsp;</span> Tambah User
					</a></li>
				</ul>
			</li>
			<!-- end user -->
			<li><a href="service/logout.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
		</ul>
	</div><!--/.sidebar-->