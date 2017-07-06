<?php

class RetValue{
	public $user_name = "no such user";
	public $user_nickname = "";
	public $phone_number = "";
	public $picture = "";
	public $longitude = 0.0;
	public $latitude = 0.0;
}

$servername = "localhost";
$sqluser = "root";
$sqlpasswd = "root";
$database = "weischool";
$ret = new RetValue();

if(isset($_REQUEST['user_id'])){
	$conn = new mysqli($servername, $sqluser, $sqlpasswd, $database);
	if ($conn->connect_error) {
		die("连接失败: " . $conn->connect_error);
	}

	// 查询用户是否存在
	$sql = "SELECT * from user where user_id=" . $_REQUEST['user_id'] . ";";
	$result = $conn->query($sql);
	if($result->num_rows == 0)
		goto out;

	// 返回参数
	$userdata = $result->fetch_assoc();
	$ret->user_name = 	$userdata['user_name'];
	$ret->user_nickname = 	$userdata['user_nickname'];
	$ret->phone_number = 	$userdata['phone_number'];
	$ret->picture = 	$userdata['picture'];
	$ret->longitude = 	floatval($userdata['longitude']);
	$ret->latitude = 	floatval($userdata['latitude']);
}
out:
echo json_encode($ret);

?>
