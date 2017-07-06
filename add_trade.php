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

if(	isset($_REQUEST['my_user_id']) && 
	isset($_REQUEST['trader_user_id']) &&
	isset($_REQUEST['my_item_id']) &&
	isset($_REQUEST['trader_item_id']) &&
	$_REQUEST['my_user_id'] != $_REQUEST['trader_user_id']){
	$conn = new mysqli($servername, $sqluser, $sqlpasswd, $database);
	if ($conn->connect_error) {
		die("连接失败: " . $conn->connect_error);
	}
	$conn->query("set character set 'utf8'");
	$conn->query("set names 'utf8'");

	// 添加条目
	$sql = "INSERT INTO trade values (" . 
		$_REQUEST['my_user_id'] . "," .
		$_REQUEST['trader_user_id'] . "," .
		$_REQUEST['my_item_id'] . "," .
		$_REQUEST['trader_item_id'] .
		")";
	if($conn->query($sql) != true)
		goto out;

	// item表中的状态要更新
	$sql = "UPDATE item set state=1 where item_id in (" .
		$_REQUEST['my_item_id'] . "," . $_REQUEST['trader_item_id'] .
		")";
	$conn->query($sql);

	$ret->is_ok = 1;
	$ret->error_str = "创建成功";
}
out:
echo json_encode($ret);

?>
