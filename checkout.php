<?php
header("Content-Type: application/json");
session_start();
if(!isset($_SESSION['username'])){
	die("Request forgery detected");
}

$cartJson = file_get_contents('php://input');
$cartJson = json_decode($cartJson, true);
$username = $_SESSION['username'];
//echo $username;
//echo $cartJson;

//$username = "test123";

$cost = 0.0;
$amount = 0;
for ($i = 0; $i < count($cartJson); $i++){
    $cost = $cartJson[$i]['price'] * $cartJson[$i]['amount'] + $cost;
    $amount = $cartJson[$i]['amount'] + $amount;
}
//echo $cost;

require 'database.php';
$stmt = $mysqli->prepare("INSERT INTO orders (username, amount, cost) values (?, ?, ?)");
$stmt->bind_param('sid', $username, $amount, $cost);
$stmt->execute();
$stmt->close();
//
//require 'Mod8-Database.php';
$stmt = $mysqli->prepare("SELECT order_id FROM orders WHERE username = ? ORDER BY order_time DESC LIMIT 1");
$stmt->bind_param('s', $username);
$stmt->execute();
$stmt->bind_result($order_id);
$stmt->fetch();
$stmt->close();
//
for ($i = 0; $i < count($cartJson); $i++){
//		require 'Mod8-Database.php';
    $stmt = $mysqli->prepare("INSERT INTO order_detail (order_id, food_id, quantity) values (?, ?, ?)");
    $stmt->bind_param('iii', $order_id, $cartJson[$i]["foodId"], $cartJson[$i]["amount"]);
    $stmt->execute();
    $stmt->close();
	
}

echo json_encode(array(
	"success" => true,
	"message" => "You are now registered",
	"result" => $cartJson
));

?>