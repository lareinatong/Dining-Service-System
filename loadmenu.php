<?php
header("Content-Type: application/json");
session_start();
require 'database.php';
if(!isset($_POST['username'])){
	die("Request forgery detected");
}
$stmt = $mysqli->prepare("SELECT * FROM menu ORDER BY location");
if(!$stmt){
	echo json_encode(array(
	"success" => false,
	"message" => "DUC doesn't offer anything at this time"
	));
	exit;
}
$stmt->execute();
$result = $stmt->get_result();
$_SESSION['menu'] = array();
while($row = $result->fetch_assoc()){
	array_push($_SESSION['menu'], array(
			"id" => $row["food_id"],
			"name" => $row["name"],
			"price" => $row["price"],
			"location" => $row["location"],
			"prepTime" => $row["prep_time"],
                        "calories" => $row["calories"],
                        "servingSize" => $row["serving_size"],
                        "totalFat" => $row["total_fat"],
                        "cholesterol" => $row["cholesterol"],
                        "sodium" => $row["sodium"],
                        "totalCarbs" => $row["total_carbs"],
                        "protein" => $row["protein"],
                        "calcium" => $row["calcium"],
			"quantity" => 0
		)
	);
}
$stmt->close();
echo json_encode(array(
	"success" => true,
	"message" => "Successful",
        "username" => $_SESSION['username'],
	"result" => $_SESSION['menu']
));

?>