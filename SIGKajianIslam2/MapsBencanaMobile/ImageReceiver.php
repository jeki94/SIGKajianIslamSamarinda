<?php
    // requires php5
	$random = random_word(20);
    define('UPLOAD_DIR', '../image/bencana/');
    $img = $_POST['gambar'];
    $img = str_replace('data:image/JPEG;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);
    $file = UPLOAD_DIR . 'IMG_'.$random . '.png';
    $success = file_put_contents($file, $data);
    print $success ? $file : 'Unable to save the file.';

        function random_word($id = 20){
		$pool = '1234567890abcdefghijkmnpqrstuvwxyz';
		
		$word = '';
		for ($i = 0; $i < $id; $i++){
			$word .= substr($pool, mt_rand(0, strlen($pool) -1), 1);
		}
		return $word; 
	}
?>