<?php

class RetValue{
	public $is_ok = 0;
	public $error_str = "不存在物品";
}

$servername = "localhost";
$sqluser = "root";
$sqlpasswd = "root";
$database = "weischool";
$ret = new RetValue();

if(isset($_REQUEST['item_id'])){
	$conn = new mysqli($servername, $sqluser, $sqlpasswd, $database);
	if ($conn->connect_error) {
		die("连接失败: " . $conn->connect_error);
	}
	$conn->query("set character set 'utf8'");
	$conn->query("set names 'utf8'");

	// 删除物品
	$sql = "delete from item where item_id=" . $_REQUEST['item_id'];

	$ret->is_ok = 1;
	$ret->error_str = "删除成功";
}
out:
echo json_encode($ret);

?>
