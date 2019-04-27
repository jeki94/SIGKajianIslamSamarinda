<?php
include("../../settings/koneksi.php");
 

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
            $queryMarker = "SELECT * FROM bencana where id_bencana=".htmlspecialchars($_GET["id_bencana"]) ;
            $getData = $conn->prepare($queryMarker);
            $getData->execute();

            $result = $getData->fetchAll(PDO::FETCH_ASSOC);

            foreach($result as $data){
                array_push($response,
                    array(
                        'id_bencana'=>$data['id_bencana'],
                        'nama_bencana'=>$data['nama_bencana'],
                        'lat'=>$data['lat'],
                        'lng'=>$data['lng'],
                        'tgl'=>$data['tgl'],
                    	'lokasi'=>$data['lokasi'],
                    	'korban'=>$data['korban'],
                    	'kerugian'=>$data['kerugian'],
                    	'penyebab'=>$data['penyebab'],
                    	'keterangan'=>$data['keterangan'],
                    	'gambar'=>$data['gambar'])
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
