<?php 
 /*

 */

 define('HOST','localhost');
 define('USER','root');
 define('PASS','');
 define('DB','sigkajianislamv2');
 define('SERVER_API_KEY','AIzaSyDW0Y2FupzxLw8GAO3QQA1TuZvY2Qzldxc');

$con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect');

$api_google = "https://maps.googleapis.com/maps/api/js?key=AIzaSyBQoatlqOLuFFQLTW_BHbtDHeLUQZW5h6U&callback=initMap";
	
 $address = '192.168.1.4'; // penting kalo make lokal sering2 d ganti sesuaikan ip
 $folder = 'SIGKajianIslam2';
 $imagePoster='image/poster/';
 $imageTempat = 'image/tempat/';
 $imageKTP = 'image/ktp/';
 $server = 'http://'.$address.'/'.$folder.'/';
 
 $default = 'Belum Diketahui';
 // $min = "-";
 // $verifikasi = 'Verified';
 $noVerifikasi = 'BelumVerifikasi';
 //$admin = 'admin';
 //$user = 'user';
 // $aktif = 'aktif';
 // $histori = 'histori';


 ?>



