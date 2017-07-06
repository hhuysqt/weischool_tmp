<?php
header("Content-Type:text/html;charset=utf-8");

class RetValue{
	public $name;
	public $user_id;
	public $item_class;
	public $state;
	public $publish_time;
	public $introduction;
	public $picture;
	public $latitude;
	public $longitude;
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

	// 查询用户的商品
	$sql = "SELECT * from item where item_id=" . $_REQUEST['item_id'] . " ";
	$result = $conn->query($sql);
	if($result->num_rows == 0)
		goto out;

	// 返回参数
	$itemdata = $result->fetch_assoc();
	$ret->name = $itemdata['name'];
	$ret->user_id = intval($itemdata['user_id']);
	$ret->item_class = intval($itemdata['item_class']);
	$ret->state = intval($itemdata['state']);
	$ret->publish_time = $itemdata['publish_time'];
	$ret->introduction = $itemdata['introduction'];
	$ret->picture = $itemdata['picture'];

	$sql = "select * from user where user_id=" . $ret->user_id;
	$result = $conn->query($sql);
	$user_pos = $result->fetch_assoc();
	$ret->latitude = floatval($user_pos['latitude']);
	$ret->longitude = floatval($user_pos['longitude']);
}
out:
echo json_encode($ret);

?>
