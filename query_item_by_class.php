<?php
header("Content-Type:text/html;charset=utf-8");

class RetValue{
	public $item_id;
	public $user_id;
	public $name;
	public $introduction;
	public $picture;
}

$servername = "localhost";
$sqluser = "root";
$sqlpasswd = "root";
$database = "weischool";
$ret = array();

if(isset($_REQUEST['item_class'])){
	$conn = new mysqli($servername, $sqluser, $sqlpasswd, $database);
	if ($conn->connect_error) {
		die("连接失败: " . $conn->connect_error);
	}
	$conn->query("set character set 'utf8'");
	$conn->query("set names 'utf8'");

	// 查询用户的商品
	$sql = "SELECT * from item where state=0 and item_class=" . $_REQUEST['item_class'] . " ";
	if(isset($_REQUEST['start']) && isset($_REQUEST['count']))
		$sql .= "LIMIT " . $_REQUEST['start'] . "," . $_REQUEST['count'];
	$result = $conn->query($sql);
	if($result->num_rows == 0)
		goto out;

	// 返回参数
	while($itemdata = $result->fetch_assoc()){
		$one_item = new RetValue();
		$one_item->item_id = intval($itemdata['item_id']);
		$one_item->user_id = intval($itemdata['user_id']);
		$one_item->name = $itemdata['name'];
		$one_item->introduction = $itemdata['introduction'];
		$one_item->picture = $itemdata['picture'];
		array_push($ret, $one_item);
	}
}
out:
echo json_encode($ret);

?>
