<?php
class Img{
	public $img_url = "";
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
	$myfile = array_values($_FILES);
	$dest_path = "img/" . time();
	while(file_exists($dest_path))
		$dest_path .= "r";
	move_uploaded_file($myfile[0]["tmp_name"], $dest_path);

	// 返回json数据
	$img = new Img();
	$img->img_url = $dest_path;
	echo json_encode($img);
}

?>
