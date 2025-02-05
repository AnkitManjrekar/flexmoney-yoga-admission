<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

include "config.php";

$data = json_decode(file_get_contents("php://input"), true);



$name = $data['name'];
$email = $data['email'];
$age = $data['age'];
$phone = $data['phone'];
$batch = $data['batch'];
$month_year = $data['month'];
$agreement =  $data['agreement'];

// $sql = "INSERT INTO `users_details`(`name`, `email`, `age`, `phone`) VALUES ('$name','$email', $age,'$phone')";

try {
    $stmt = $con->prepare("INSERT INTO `users_details`(`name`, `email`, `age`, `phone`) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $name, $email, $age, $phone);




    if ($stmt->execute()) {
        $user_id = $stmt->insert_id;
        $sql2 = "INSERT INTO registration (user_id, batch_time, month_year, `agree_terms`) VALUES ($user_id, '$batch', '$month_year', '$agreement')";
        $con->query($sql2);

        // Call Payment API
        $paymentData = ["user_id" => $user_id];
        $ch = curl_init("http://localhost/flexmoney-yoga-admission/payment.php"); // Change this to your hosted URL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($paymentData));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        $paymentResponse = curl_exec($ch);
        $paymentData = json_decode($paymentResponse, true);
        curl_close($ch);

        if ($paymentData["status"]) {
            echo json_encode(["message" => "Form Submitted Successfully", "status" => true]);
        }
    } else {
        throw new Exception("SQL Error: " . $con->error);
    }

    $stmt->close();
} catch (Exception $e) {
    echo json_encode(["message" => $e->getMessage(), "status" => false]);
}
