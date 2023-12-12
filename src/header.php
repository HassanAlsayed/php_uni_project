<?php
require "../config/database.php";

session_start();

if (isset($_SESSION["username"], $_SESSION["user_id"], $_SESSION["role"])) {
    $username = $_SESSION["username"];
    $user_id = $_SESSION["user_id"];
    $role = $_SESSION["role"];
} else {
    header("Location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <nav class="h-20 flex items-center">
        <div class="container mx-auto flex items-center justify-between">
            <h1 class="font-bold">Clinic</h1>
            <ul class="flex ml-4 items-center flex-1 space-x-2">
                <li><a href="home.php">Home</a></li>
                <li>
                    <a href="patient.php">Patients</a>
                </li>
                <li>
                    <a href="appointment.php">Appointments</a>
                </li>
                <?php if ($role == "admin") { ?>
                    <li>
                        <a href="users.php">Manage users</a>
                    </li>
                <?php } ?>
            </ul>
            <div>
                <a href="login.php">Login</a>
                <a href="logout.php">Logout</a>
                <a href="profile.php">Profile</a>
            </div>
        </div>
    </nav>