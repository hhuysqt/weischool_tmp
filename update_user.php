<?php

class RetValue{
	public $is_ok = 0;
	public $error_str = "用户不存在";
}

$servername = "localhost";
$sqluser = "root";
$sqlpasswd = "root";
$database = "weischool";
$ret = new RetValue();

if(isset($_REQUEST['user_id'])){
	// 用户id必要
	$conn = new mysqli($servername, $sqluser, $sqlpasswd, $database);
	if ($conn->connect_error) {
		die("连接失败: " . $conn->connect_error);
	}

	// 查询用户是否存在
	$sql = "SELECT user_id from user where user_id=" . $_REQUEST['user_id'];
	$result = $conn->query($sql);
	if($result->num_rows == 0)
		goto out;

	// 返回参数
	$update_list = "";
	if(isset($_REQUEST['user_name'])){
		$update_list .= "user_name = '" .
			$_REQUEST['user_name'] . "'";
	}
	if(isset($_REQUEST['password'])){
		if($update_list != "")
			$update_list .= ", ";
		$update_list .= "password = '" .
			$_REQUEST['password'] . "'";
	}
	if(isset($_REQUEST['user_nickname'])){
		if($update_list != "")
			$update_list .= ", ";
		$update_list .= "user_nickname = '" .
			$_REQUEST['user_nickname'] . "'";
	}
	if(isset($_REQUEST['phone_number'])){
		if($update_list != "")
			$update_list .= ", ";
		$update_list .= "phone_number = '" .
			$_REQUEST['phone_number'] . "'";
	}
	if(isset($_REQUEST['picture'])){
		if($update_list != "")
			$update_list .= ", ";
		$update_list .= "picture = '" .
			$_REQUEST['picture'] . "'";
	}
	if(isset($_REQUEST['longitude']) && isset($_REQUEST['latitude'])){
		if($update_list != "")
			$update_list .= ", ";
		$update_list .= "longitude = " . $_REQUEST['longitude'] .
			", latitude = " . $_REQUEST['latitude'];
	}
	$sql = "UPDATE user set " . $update_list . " where user_id = " . $_REQUEST['user_id'];
	if(!$conn->query($sql))
		break;
	$ret->is_ok = 1;
	$ret->error_str = "更新成功";
}
out:
echo json_encode($ret);

?>
