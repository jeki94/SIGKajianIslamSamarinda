<?php 
include('../settings/koneksi.php') ;
include('service/auth.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <title>Kajian Islam Samarinda - Dashboard</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/datepicker3.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    
    <!--Custom Font-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.css" />
    <script type='text/javascript' src='http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.js'></script>
    <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js'></script>
    <!-- <style>#map-canvas {height: 500px;width: 100%;}</style> -->
    <style type="text/css">#map-canvas {height: 500px;width: 100%;}</style>
    <?php include('service/NotifService.php') ?>
</head>
<body>
    <?php include('header.php') ?>
    <?php include('sidebar.php') ?>
<!--     <?php include('service/NotifService.php') ?>   -->   <!-- kalo error di konsole -->   
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
                <li class="active">Dashboard</li>
            </ol>
        </div><!--/.row-->
        
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dashboard</h1>
            </div>
        </div><!--/.row-->
    
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Lokasi Kajian Islam
                        
                        <span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>

                    <!-- modal show gambar / mau nambah -->
                        <div id='details' class='modal fade' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                            <div class='modal-dialog'>
                                <div class='modal-content'>
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title"></h4></div>
                                    <div class='modal-body'>
                                        <!-- <p>dancok $gambar</p> -->
                                        <div class="fetched-data"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end modal show gambar-->

                    <div class="panel-body" id="map-canvas">
                        
                        <!-- kalo mau nambah -->
                        <script type='text/javascript'>
                            var map = L.map( 'map-canvas', {
                                center: [ -0.49841,117.14245],
                                minZoom: 2,
                                zoom: 14
                            })

                            L.tileLayer( 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
                                subdomains: ['a', 'b', 'c']
                            }).addTo( map )
 

                            <?php

                            $query = mysqli_query($con,"select * from formkajian where statuskajian='Aktif'");
                            while ($data = mysqli_fetch_array($query))
                            {
                                $id = $data['id_kajian'];
                                $namakajian = $data['namakajian'];
                                $lat = $data['lat'];
                                $lon = $data['lng'];

                                echo ("L.marker( [$lat, $lon]).bindPopup(  'Kajian : $namakajian<br/>Latitude : $lat<br/>Longitude : $lon <br/><button data-toggle=modal data-target=#details data-id=$id>Details</button>' ).addTo( map );");
                            }

                            ?>
                            
                        </script>

                        <script type="text/javascript">
                                $(document).ready(function(){
                                    $('#details').on('show.bs.modal', function (e) {
                                        var rowidDetBen = $(e.relatedTarget).data('id');
                                        //menggunakan fungsi ajax untuk pengambilan data
                                        $.ajax({
                                            type : 'post',
                                            url : 'service/function.php',
                                            data :  'rowidDetBen='+ rowidDetBen,
                                            success : function(data){
                                            $('.fetched-data').html(data);//menampilkan data ke dalam modal
                                        }
                                    });
                                    });
                                });
                            </script>
                            <!-- end script modal image -->

                            <!-- select bencana script -->
                            <script type="text/javascript">
                                var formkajian = document.querySelector(".dropdown-settings");
                                formkajian.addEventListener("click", function(e)
                                {
                                    alert($(this).data('formkajian'));
                                });
                            </script>

                        
<?php include('footer.php') ?>

</body>
</html>