<?php
// get query user_id

include "../index.php";
include "../config/database.php";
include "./header.php";

$user_id = $_GET['user_id'];
$role = $_GET['role'];

if ($role == "admin" || $role == "secretary") {
    $sql = "SELECT * FROM users AS u
            INNER JOIN adminssecretaries AS a ON u.user_id = a.user_id
            WHERE u.user_id = $user_id";
} else {
    $sql = "SELECT * FROM users AS u
            INNER JOIN doctors AS d ON u.user_id = d.user_id
            WHERE u.user_id = $user_id";
}


$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    print_r($row);
}
