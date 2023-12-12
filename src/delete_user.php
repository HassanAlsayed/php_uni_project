<?php

include "../index.php";
include "../config/database.php";

$user_id = $_POST['user_id'];
$role = $_POST['role'];


if ($role == "admin" || $role == "secretary") {
    $sql = "DELETE FROM adminssecretaries WHERE user_id = $user_id";

    if ($conn->query($sql) === TRUE) {
        $sql = "DELETE FROM users WHERE user_id = $user_id";
        if ($conn->query($sql) === TRUE) {
            echo "Record deleted successfully";
        }
    }
} else {
    $sql = "DELETE FROM doctors WHERE user_id = $user_id";
    if ($conn->query($sql) === TRUE) {
        $sql = "DELETE FROM users WHERE user_id = $user_id";
        if ($conn->query($sql) === TRUE) {
            echo "Record deleted successfully";
        }
    }
}

header("Location: ./users.php");

$conn->close();
