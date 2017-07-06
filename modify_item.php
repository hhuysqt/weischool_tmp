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
	// 用户id必要
	$conn = new mysqli($servername, $sqluser, $sqlpasswd, $database);
	if ($conn->connect_error) {
		die("连接失败: " . $conn->connect_error);
	}
	$conn->query("set character set 'utf8'");
	$conn->query("set names 'utf8'");

	// 查询物品是否存在
	$sql = "SELECT item_id from item where item_id=" . $_REQUEST['item_id'];
	$result = $conn->query($sql);
	if($result->num_rows == 0)
		goto out;

	// 返回参数
	$update_list = "";
	if(isset($_REQUEST['name'])){
		$update_list .= "name = '" .
			$_REQUEST['name'] . "'";
	}
	if(isset($_REQUEST['item_class'])){
		if($update_list != "")
			$update_list .= ", ";
		$update_list .= "item_class = '" .
			$_REQUEST['item_class'] . "'";
	}
	if(isset($_REQUEST['state'])){
		if($update_list != "")
			$update_list .= ", ";
		$update_list .= "state = " .
			$_REQUEST['state'];
	}
	if(isset($_REQUEST['introduction'])){
		if($update_list != "")
			$update_list .= ", ";
		$update_list .= "introduction = '" .
			$_REQUEST['introduction'] . "'";
	}
	if(isset($_REQUEST['picture'])){
		if($update_list != "")
			$update_list .= ", ";
		$update_list .= "picture = '" .
			$_REQUEST['picture'] . "'";
	}
	if($update_list == ""){
		$ret->error_str = "没收到要更改的数据";
		goto out;
	}
	$sql = "UPDATE item set " . $update_list . " where item_id = " . $_REQUEST['item_id'];
	if(!$conn->query($sql))
		goto out;
	$ret->is_ok = 1;
	$ret->error_str = "更新成功";
}
out:
echo json_encode($ret);

?>
