<?php
header("Content-Type: application/json");

include "config.php";

$data = json_decode(file_get_contents("php://input"), true);

$user_id = $data['user_id'];
$amount = 500;

// Mock Function
function CompletePayment($user_id, $amount)
{
    return true;
}

$payment_status = CompletePayment($user_id, $amount);

if ($payment_status) {
    $con->query("INSERT INTO payments_details (user_id, amount, status) VALUES ($user_id, 500, 'completed')");
    echo json_encode(["message" => "Payment successful", "status" => true]);
} else {
    echo json_encode(["message" => "Payment failed", "status" => false]);
}

$con->close();
