<?php
include("../settings/koneksi.php");
 

 class JsonDisplayMarker {
    function getMarkers(){
        //buat koneksinya
        $connection = new Connection();
        $conn = $connection->getConnection();

        //buat responsenya
        $response = array();

        $code = "code";
        $message = "message";

        try{
            //tampilkan semua data dari mysql
            $queryMarker = "SELECT * FROM formkajian where id_kajian=".htmlspecialchars($_GET["id_kajian"]) ;
            $getData = $conn->prepare($queryMarker);
            $getData->execute();

            $result = $getData->fetchAll(PDO::FETCH_ASSOC);

            foreach($result as $data){
                array_push($response,
                    array(
                        'id_kajian'=>$data['id_kajian'],
                        'namakajian'=>$data['namakajian'],
                        'namapemateri'=>$data['namapemateri'],
                        'namatempat'=>$data['namatempat'],
                        'lat'=>$data['lat'],
                    	'lng'=>$data['lng'],
                    	'alamat'=>$data['alamat'],
                    	'kelurahan'=>$data['kelurahan'],
                    	'kecamatan'=>$data['kecamatan'],
                    	'tanggalkajian'=>$data['tanggalkajian'],
                    	'waktumulai'=>$data['waktumulai'],
                    	'waktuselesai'=>$data['waktuselesai'],
                    	'kuota'=>$data['kuota'],
                    	'statuspeserta'=>$data['statuspeserta'],
                    	'statusberbayar'=>$data['statusberbayar'],
                    	'pengelola'=>$data['Pengelola'],
                    	'kontakpengelola'=>$data['kontakpengelola'],
                    	'informasi'=>$data['informasi'],
                    	'gambarposter'=>$data['fotoposter'],
                    	'gambartempat'=>$data['fototempat'])
                    );
            }
        }catch (PDOException $e){
            echo "Failed displaying data".$e->getMessage();
        }

        //buatkan kondisi jika berhasil atau tidaknya
        if($queryMarker){
            echo json_encode(
                array("data"=>$response,$code=>1,$message=>"Success")
            );
        }else{
            echo json_encode(
                array("data"=>$response,$code=>0,$message=>"Failed displaying data")
            );
        }


    }
}

$location = new JsonDisplayMarker();
$location->getMarkers();

class Connection {
    function getConnection(){
        $host       = HOST;
        $username   = USER;
        $password   = PASS;
        $dbname     = DB;

        try{
            $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        }catch (Exception $e){
            echo $e->getMessage();
        }
    }
}
