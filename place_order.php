<?php
session_start();

if (!isset($_SESSION['username'])) {
    http_response_code(401);
    exit("Unauthorized");
}

$conn = new mysqli("localhost", "root", "", "login_db");

if ($conn->connect_error) {
    die("DB Error");
}

// Read JSON input
$data = json_decode(file_get_contents("php://input"), true);

$username = $_SESSION['username'];
$phone = $data['phone'];
$address = $data['address'];
$total = $data['total'];
$items = json_encode($data['cart']);

// Insert order
$sql = "INSERT INTO orders 
(username, phone, address, total_amount, order_items)
VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssds", $username, $phone, $address, $total, $items);

if ($stmt->execute()) {
    echo "success";
} else {
    echo "error";
}

$stmt->close();
$conn->close();
?>
