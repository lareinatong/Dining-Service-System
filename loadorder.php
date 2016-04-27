<?php
header("Content-Type: application/json");
ini_set("session.cookie_httponly", 1);
session_start();
if(!isset($_SESSION['username'])){
	die("Request forgery detected");
}
$username = $_SESSION['username'];
require 'database.php';
$stmt = $mysqli->prepare("SELECT order_id, order_time, amount, cost, status FROM orders WHERE username = ? ORDER BY order_time DESC");
if(!$stmt){
	echo json_encode(array(
	"success" => false,
	"message" => "Something is wrong"
	));
	exit;
}
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();
$array = array();
while($row = $result->fetch_assoc()){
	array_push($array, array(
			"id" => $row["order_id"],
			"time" => $row["order_time"],
                        "amount" => $row["amount"],
                        "cost" => $row["cost"],
			"status" => $row["status"]
		)
	);
}
$stmt->close();
echo json_encode(array(
	"success" => true,
	"message" => "Successful",
	"result" => $array
));
?>