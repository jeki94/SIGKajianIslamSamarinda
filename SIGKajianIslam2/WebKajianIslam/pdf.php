<?php
include 'fpdf181/fpdf.php';
include 'fpdf181/exfpdf.php';
include 'fpdf181/easyTable.php';
include('../settings/koneksi.php') ;

if (isset($_GET['tahun'])) {

 $tahun = $_GET['tahun'];
 $bulan = $_GET['bulan'];
 // $waktu = new DateTime();
 date_default_timezone_set('Asia/Makassar'); 
 $tgl = date("Y-m-d H:i:s");

$dateObj   = DateTime::createFromFormat('!m', $bulan);
$namaBulan = $dateObj->format('F'); // March
$NAMABULANBESAR = strtoupper($namaBulan);

 $tanggal = date_format (new DateTime($tgl), 'd-m-Y');
 $waktu = date_format (new DateTime($tgl), 'H:i:s');
 $hari = $tanggal."(".$waktu.")";

 $pdf=new exFPDF();
 $pdf->AddPage('A4',0,'L'); 
 $pdf->SetFont('helvetica','',10);
 $pdf->AddFont('FontUTF8','','Arimo-Regular.php'); 
 $pdf->AddFont('FontUTF8','B','Arimo-Bold.php');
 $pdf->AddFont('FontUTF8','I','Arimo-Italic.php');
 $pdf->AddFont('FontUTF8','BI','Arimo-BoldItalic.php');

 $table1=new easyTable($pdf, 2);
 $table1->easyCell('', 'img:img/maps_bencana.png, w30; align:L;');
 $table1->printRow();

 $table1->rowStyle('font-size:15; font-style:B;');
 $table1->easyCell('Sisterm Informasi Kajian Islam Ver 1.0');
 $table1->printRow();
 
 $table1->rowStyle('font-size:12;');
 $table1->easyCell("<b>Bulan :</b> ".$namaBulan."\n<b>Tahun:</b> ".$tahun."\n<b>Waktu :</b>".$hari);
 $table1->printRow(); 
 $table1->endTable(5);

 $table=new easyTable($pdf, '{30, 30, 30, 30, 30, 30,30,30,30,30,30,30,30,30,30}', 'width:170; border-color:#ffff00; font-size:10; border:1; paddingY:2;');

 $table->rowStyle('align:{RCC}; bgcolor:#00ace6;font-style:B');
 $table->easyCell("Nama Kajian");
 $table->easyCell("Nama Pemateri");
 $table->easyCell("Nama Tempat");
 $table->easyCell("Alamat");
 $table->easyCell("Kelurahan");
 $table->easyCell("Kecamatan");
 $table->easyCell("Tanggal Kajian");
 $table->easyCell("Waktu Mulai");
 $table->easyCell("Waktu Selesai");
 $table->easyCell("Kuota");
 $table->easyCell("Status Peserta");
 $table->easyCell("Status Berbayar");
 $table->easyCell("Pengelola");
 $table->easyCell("Kontak Pengelola");
 $table->easyCell("Publisher");
 $table->printRow(true);

 // $query = mysqli_query($con,"select * from bencana"); 
 $query = mysqli_query($con, "SELECT namakajian,namapemateri,namatempat,lat,lng,alamat,kelurahan,kecamatan,tanggalkajian,waktumulai,waktuselesai,kuota,statuspeserta,statusberbayar,pengelola,kontakpengelola, username.username FROM formkajian JOIN username ON formkajian.id_username = username.id_username WHERE formkajian.statuskajian='TelahSelesai' && tanggalkajian LIKE '%".$tahun."-".$bulan."%'"."ORDER BY id_kajian && MONTH(tanggalkajian) = MONTH(CURRENT_DATE)");
 while ($data = mysqli_fetch_array($query))
 {
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
						$author = $data['username'];

 $table->easyCell("$namakajian");
 $table->easyCell("$namapemateri");
 $table->easyCell("$namatempat");
 $table->easyCell("$alamat");
 $table->easyCell("$kelurahan");
 $table->easyCell("$kecamatan");
 $table->easyCell("$tanggalkajian");
 $table->easyCell("$waktumulai");
 $table->easyCell("$waktuselesai");
 $table->easyCell("$kuota");
 $table->easyCell("$statuspeserta");
 $table->easyCell("$statusberbayar");
 $table->easyCell("$pengelola");
 $table->easyCell("$kontakpengelola");
 $table->easyCell("$author");
 $table->printRow();}

// rekapitulasi
 
 $table->rowStyle('border:N;border-color:#a1a1a1');
 $table->easyCell('Rekapitulasi :','align:L;colspan:2; line-height:0.8;paddingY:5;'); 
 $table->printRow();

 $table->rowStyle('border:N;border-color:#a1a1a1');
 $query = mysqli_query($con, " SELECT COUNT(namakajian) as jumlah FROM formkajian WHERE formkajian.statuskajian='TelahSelesai'  && tanggalkajian like '%".$tahun."-".$bulan."%'");
 while ($data = mysqli_fetch_array($query))
 {
 	 $jumlah = $data['jumlah'];
 	 // $table->easyCell('jumlah','align:L;colspan:2;'); 
 	 // $table->easyCell(': '.$jumlah.' Kali/Kejadian','align:L;colspan:2;'); 

 }
 $table->easyCell('Kajian Islam Bulan :'.$NAMABULANBESAR.' Tahun '.$tahun.' Sebanyak = '.$jumlah,' align:L;colspan:4; line-height:0.8;paddingY:2;'); 
 $table->printRow();

 $table->rowStyle('border:N;border-color:#a1a1a1');
 $query = mysqli_query($con, " SELECT COUNT(namakajian) as jumlah FROM formkajian WHERE tanggalkajian like '%".$tahun."-".$bulan."%'");
 while ($data = mysqli_fetch_array($query))
 {
 	 $jumlah = $data['jumlah'];
 	 $table->easyCell('jumlah','align:L;colspan:2;'); 
 	 $table->easyCell(': '.$jumlah.' Kali/Kejadian','align:L;colspan:2;'); 

 }

//  $query = mysqli_query($con, " SELECT COUNT(nama_bencana) as jumlah FROM bencana WHERE nama_bencana = 'kebakaran'AND tgl like '%".$tahun."-".$bulan."%'");
//  while ($data = mysqli_fetch_array($query))
//  {
//  	 $jumlah = $data['jumlah'];
//  	 $table->easyCell('5. Kebakaran','align:L;colspan:2;'); 
//  	 $table->easyCell(': '.$jumlah.' Kali/Kejadian','align:L;colspan:2;');  
//  	 $table->printRow();

//  }

//  $table->rowStyle('border:N;border-color:#a1a1a1');
//  $query = mysqli_query($con, " SELECT COUNT(nama_bencana) as jumlah FROM bencana WHERE nama_bencana = 'tanah longsor'AND tgl like '%".$tahun."-".$bulan."%'");
//  while ($data = mysqli_fetch_array($query))
//  {
//  	 $jumlah = $data['jumlah'];
//  	 $table->easyCell('2. Tanah Longsor','align:L;colspan:2;'); 
//  	 $table->easyCell(': '.$jumlah.' Kali/Kejadian','align:L;colspan:2;'); 

//  }

//  $query = mysqli_query($con, " SELECT COUNT(nama_bencana) as jumlah FROM bencana WHERE nama_bencana = 'puting beliung'AND tgl like '%".$tahun."-".$bulan."%'");
//  while ($data = mysqli_fetch_array($query))
//  {
//  	 $jumlah = $data['jumlah'];
//  	 $table->easyCell('6. Puting Beliung : ','align:L;colspan:2;'); 
//  	 $table->easyCell(': '.$jumlah.' Kali/Kejadian','align:L;colspan:2;');  
//  	 $table->printRow();

//  }

//  $table->rowStyle('border:N;border-color:#a1a1a1');
//  $query = mysqli_query($con, " SELECT COUNT(nama_bencana) as jumlah FROM bencana WHERE nama_bencana = 'pohon tumbang'AND tgl like '%".$tahun."-".$bulan."%'");
//  while ($data = mysqli_fetch_array($query))
//  {
//  	 $jumlah = $data['jumlah'];
//  	 $table->easyCell('3. Pohon Tumbang','align:L;colspan:2;'); 
//  	 $table->easyCell(': '.$jumlah.' Kali/Kejadian','align:L;colspan:2;'); 

//  }

//  $query = mysqli_query($con, " SELECT COUNT(nama_bencana) as jumlah FROM bencana WHERE nama_bencana = 'Konflik sosial'AND tgl like '%".$tahun."-".$bulan."%'");
//  while ($data = mysqli_fetch_array($query))
//  {
//  	 $jumlah = $data['jumlah'];
//  	 $table->easyCell('7. Konflik Sosial : ','align:L;colspan:2;'); 
//  	 $table->easyCell(': '.$jumlah.' Kali/Kejadian','align:L;colspan:2;');  
//  	 $table->printRow();

//  }

// $table->rowStyle('border:N;border-color:#a1a1a1');
// $query = mysqli_query($con, " SELECT COUNT(nama_bencana) as jumlah FROM bencana WHERE nama_bencana = 'orang tenggelam'AND tgl like '%".$tahun."-".$bulan."%'");
//  while ($data = mysqli_fetch_array($query))
//  {
//  	 $jumlah = $data['jumlah'];
//  	 $table->easyCell('4. Orang Tenggelam : ','align:L;colspan:2;'); 
//  	 $table->easyCell(': '.$jumlah.' Kali/Kejadian','align:L;colspan:2;'); 
//  	 $table->printRow();

//  }

 
// end rekapitulasi

 $pdf->AddPage(270,0,'L');
 $pdf->Output(); 

}?>