<?php
header("Content-Type:text/html;charset=utf-8");

class RetValue{
	public $trader;
	public $trader_id;
	public $trader_picture;
	public $trader_item_id;
	public $trader_item_name;
	public $trader_item_picture;
	public $my_item_id;
	public $my_item_name;
	public $my_item_picture;
}

$servername = "localhost";
$sqluser = "root";
$sqlpasswd = "root";
$database = "weischool";
$ret = array();

function push_to_result($result){
	while($itemdata = $result->fetch_assoc()){
		$one_item = new RetValue();
		$one_item->trader = $itemdata['trader'];
		$one_item->trader_id = intval($itemdata['trader_id']);
		$one_item->trader_picture = $itemdata['trader_picture'];
		$one_item->trader_item_id = intval($itemdata['trader_item_id']);
		$one_item->trader_item_name = $itemdata['trader_item_name'];
		$one_item->trader_item_picture = $itemdata['trader_item_picture'];
		$one_item->my_item_id = intval($itemdata['my_item_id']);
		$one_item->my_item_name = $itemdata['my_item_name'];
		$one_item->my_item_picture = $itemdata['my_item_picture'];
		array_push($GLOBALS['ret'], $one_item);
	}
}

if(isset($_REQUEST['user_id'])){
	$conn = new mysqli($servername, $sqluser, $sqlpasswd, $database);
	if ($conn->connect_error) {
		die("连接失败: " . $conn->connect_error);
	}
	$conn->query("set character set 'utf8'");
	$conn->query("set names 'utf8'");

	// 查询交易
	// 先查询由我方发出的交易
	$sql = "(SELECT 
		user.user_id as trader_id, user.user_name as trader, user.picture as trader_picture, 
		item2.item_id as trader_item_id, item2.name as trader_item_name,
		item2.picture as trader_item_picture,
		item1.item_id as my_item_id, item1.name as my_item_name, 
		item1.picture as my_item_picture 
		from trade, user, item as item1, item as item2 
		where 	trade.user2 = user.user_id and 
			trade.item2 = item2.item_id and trade.item1 = item1.item_id
			and item1.state=1 and item2.state=1
			and trade.user1 = " . $_REQUEST['user_id'] . ") union 
		(SELECT 
		user.user_id as trader_id, user.user_name as trader, user.picture as trader_picture, 
		item1.item_id as trader_item_id, item1.name as trader_item_name,
		item1.picture as trader_item_picture,
		item2.item_id as my_item_id, item2.name as my_item_name, 
		item2.picture as my_item_picture 
		from trade, user, item as item1, item as item2 
		where 	trade.user1 = user.user_id and 
			trade.item2 = item2.item_id and trade.item1 = item1.item_id
			and item1.state=1 and item2.state=1
			and trade.user2 = " . $_REQUEST['user_id'] . ") ";
	if(isset($_REQUEST['start']) && isset($_REQUEST['count']))
		$sql .= " LIMIT " . $_REQUEST['start'] . "," . $_REQUEST['count'];
	$result = $conn->query($sql);
	if($result->num_rows == 0)
		goto out;
	push_to_result($result);
	$rescount = count($ret);
}
out:
echo json_encode($ret);

?>
