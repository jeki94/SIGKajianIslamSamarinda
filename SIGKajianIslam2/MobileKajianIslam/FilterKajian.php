<?php 
include("../settings/koneksi.php");
if(isset($_GET["namakajian"]) || isset($_GET["tanggalkajian"]) || isset($_GET["waktumulai"]))
{
	class JsonDisplayMarker {

		function getMarkers(){
        //buat koneksinya
        $namakajian = $_GET["namakajian"] ?? '';
        $tanggalkajian = $_GET["tanggalkajian"] ?? '';
        $waktumulai = $_GET["waktumulai"] ?? '';
        $connection = new Connection();
        $conn = $connection->getConnection();

        //buat responsenya
        $response = array();

        $code = "code";
        $message = "message";

        try{
            //tampilkan semua data dari mysql
            // $queryMarker = "SELECT * FROM bencana where status='$aktif'";
            $queryMarker = "SELECT id_kajian, namakajian, tanggalkajian, waktumulai, lat, lng FROM formkajian WHERE namakajian LIKE '%".$namakajian."%' AND tanggalkajian LIKE '%".$tanggalkajian."%' AND waktumulai LIKE '%".$waktumulai."%' AND statuskajian LIKE '%aktif%'";
            $getData = $conn->prepare($queryMarker);
            $getData->execute();

            $result = $getData->fetchAll(PDO::FETCH_ASSOC);

            foreach($result as $data){
                array_push($response,
                    array(
                        'id_kajian'=>$data['id_kajian'],
                        'namakajian'=>$data['namakajian'],
                        'tanggalkajian'=>$data['tanggalkajian'],
                        'waktumulai'=>$data['waktumulai'],
                        'latitude'=>$data['lat'],
                        'longitude'=>$data['lng'])
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
        }}
    }

$location = new JsonDisplayMarker();
$location->getMarkers();

}
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
