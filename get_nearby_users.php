<?php

class RetValue{
	public $user_id;
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
$ret = array();

$conn = new mysqli($servername, $sqluser, $sqlpasswd, $database);
if ($conn->connect_error) {
	die("连接失败: " . $conn->connect_error);
}

// 查询所有用户
$sql = "SELECT * from user";
$result = $conn->query($sql);
if($result->num_rows == 0){
	goto out;
}

// 返回参数
while($userdata = $result->fetch_assoc()){
	$one_user = new RetValue();
	$one_user->user_id = 	intval($userdata['user_id']);
	$one_user->user_name = 	$userdata['user_name'];
	$one_user->user_nickname = $userdata['user_nickname'];
	$one_user->phone_number = $userdata['phone_number'];
	$one_user->picture = 	$userdata['picture'];
	$one_user->longitude = 	floatval($userdata['longitude']);
	$one_user->latitude = 	floatval($userdata['latitude']);
	array_push($ret, $one_user);
}
out:
echo json_encode($ret);

?>
