<?php

class RetValue{
	public $is_ok = 0;
	public $error_str = "创建失败";
}

$servername = "localhost";
$sqluser = "root";
$sqlpasswd = "root";
$database = "weischool";
$ret = new RetValue();

if(isset($_REQUEST['user_id']) && isset($_REQUEST['name'])){
	$conn = new mysqli($servername, $sqluser, $sqlpasswd, $database);
	if ($conn->connect_error) {
		die("连接失败: " . $conn->connect_error);
	}
	$conn->query("set character set 'utf8'");
	$conn->query("set names 'utf8'");

	// 添加条目
	$sql_names = "publish_time, user_id, name, item_class";
	$sql_values = "'" . date('Y-m-d') . "', " . 
		$_REQUEST['user_id'] . ", '" . $_REQUEST['name'] . "', ";
	if(isset($_REQUEST['item_class']))
		$sql_values .= $_REQUEST['item_class'];
	else
		$sql_values .= "0";	// 默认种类：“其他”
	if(isset($_REQUEST['introduction'])){
		$sql_names .= ", introduction";
		$sql_values .= ", '" . $_REQUEST['introduction'] . "'";
	}
	if(isset($_REQUEST['picture'])){
		$sql_names .= ", picture";
		$sql_values .= ", '" . $_REQUEST['picture'] . "'";
	}
	$sql = "INSERT INTO item (" . $sql_names . ") values (" . $sql_values . ");";
	if($conn->query($sql) != true)
		goto out;

	$ret->is_ok = 1;
	$ret->error_str = "创建成功";
}
out:
echo json_encode($ret);

?>
