<?php

class RetValue{
	public $is_ok;
	public $error_str;
	public $user_id;
	public $picture;
	function __construct(){
		$this->is_ok = 0;
		$this->error_str = "用户名或密码不正确";
		$this->user_id = 0;
	}
}

$servername = "localhost";
$sqluser = "root";
$sqlpasswd = "root";
$database = "weischool";
$ret = new RetValue();

// 获取传入的用户名
if(isset($_REQUEST['user_name']) && isset($_REQUEST['password'])){
	$weischooluser = $_REQUEST['user_name'];
	$weischoolpasswd = $_REQUEST['password'];
} else 
	goto out;
 
// 查询用户
$conn = new mysqli($servername, $sqluser, $sqlpasswd, $database);
if ($conn->connect_error) {
	    die("连接失败: " . $conn->connect_error);
}
$sql = "SELECT user_id,picture from user where user_name='" . $weischooluser .
	"' and password='" . $weischoolpasswd . "';";
$result = $conn->query($sql);

// 返回参数
if($result->num_rows > 0){
	$user_result = $result->fetch_assoc();
	$ret->is_ok = 1;
	$ret->user_id = intval($user_result['user_id']);
	$ret->picture = $user_result['picture'];
	$ret->error_str = "查询成功";
}

out:
echo json_encode($ret);

?>
