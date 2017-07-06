<?php

class RetValue{
	public $is_ok;
	public $error_str;
	public $user_id;
	function __construct(){
		$this->is_ok = 0;
		$this->error_str = "用户已存在";
		$this->user_id = 0;
	}
}

$servername = "localhost";
$sqluser = "root";
$sqlpasswd = "root";
$database = "weischool";
$ret = new RetValue();

if(isset($_REQUEST['user_name']) && isset($_REQUEST['password'])){
	// 用户名和密码是必要的
	$weischooluser = $_REQUEST['user_name'];
	$weischoolpasswd = $_REQUEST['password'];
	$conn = new mysqli($servername, $sqluser, $sqlpasswd, $database);
	if ($conn->connect_error) {
		die("连接失败: " . $conn->connect_error);
	}

	// 查询用户是否存在
	$sql = "SELECT user_id from user where user_name='" . $weischooluser . "';";
	$result = $conn->query($sql);
	if($result->num_rows > 0)
		goto out;

	// 返回参数
	$sql_names = "user_name, password";
	$sql_values = "'" . $weischooluser . "','" . $weischoolpasswd . "'";
	if(isset($_REQUEST['user_nickname'])){
		$sql_names .= ", user_nickname";
		$sql_values .= ", '" . $_REQUEST['user_nickname'] . "'";
	}
	if(isset($_REQUEST['phone_number'])){
		$sql_names .= ", phone_number";
		$sql_values .= ", '" . $_REQUEST['phone_number'] . "'";
	}
	if(isset($_REQUEST['picture'])){
		$sql_names .= ", picture";
		$sql_values .= ", '" . $_REQUEST['picture'] . "'";
	}
	if(isset($_REQUEST['longitude']) && isset($_REQUEST['latitude'])){
		$sql_names .= ", longitude, latitude";
		$sql_values .= ',' . $_REQUEST['longitude'] . ',' . $_REQUEST['latitude'];
	}
	$sql = "INSERT INTO user (" . $sql_names . ") values (" . $sql_values . ");";
	if($conn->query($sql) != true)
		goto out;

	$sql = "SELECT user_id from user where user_name='" . $weischooluser . "';";
	$ret->is_ok = 1;
	$ret->user_id = intval($conn->query($sql)->fetch_assoc()['user_id']);
	$ret->error_str = "创建成功";
}
out:
echo json_encode($ret);

?>
