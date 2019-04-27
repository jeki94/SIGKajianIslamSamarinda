<?php 
include("../settings/koneksi.php");
if(isset($_GET["nama_user"]))
{
	class JsonDisplayMarker {

		function getMarkers(){
        //buat koneksinya
        $username = $_GET["nama_user"];
        $aktif = 'aktif';
        $connection = new Connection();
        $conn = $connection->getConnection();

        //buat responsenya
        $response = array();

        $code = "code";
        $message = "message";

        try{
            //tampilkan semua data dari mysql
            // $queryMarker = "SELECT * FROM bencana where status='$aktif'";
            $queryMarker = "SELECT formkajian.id_kajian, formkajian.namakajian, formkajian.lat, formkajian.lng, username.username FROM formkajian INNER JOIN username ON formkajian.id_username = username.id_username WHERE username.username='$username' && formkajian.statuskajian='aktif'";
            $getData = $conn->prepare($queryMarker);
            $getData->execute();

            $result = $getData->fetchAll(PDO::FETCH_ASSOC);

            foreach($result as $data){
                array_push($response,
                    array(
                        'id_kajian'=>$data['id_kajian'],
                        'namakajian'=>$data['namakajian'],
                        'latitude'=>$data['lat'],
                        'longitude'=>$data['lng'],
                        'username' =>$data['username'])
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
