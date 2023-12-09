<?php
require "../config/database.php";

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
    <nav class="h-20 bg-gray-300 flex items-center">
        <div class="container mx-auto flex items-center justify-between">
            <h1 class="font-bold">Clinic</h1>
            <ul class="flex ml-4 items-center flex-1 space-x-2">
                <li><a href="home.php">Home</a></li>
                <li>
                    <a href="patient.php">Patients</a>
                </li>
                <li>
                    <a href="doctors.php">Doctors</a>
                </li>
                <li>
                    <a href="appointment.php">Appointment</a>
                </li>
            </ul>
            <div>
                <a href="register.php">Register</a>
                <a href="login.php">Login</a>
                <a href="logout.php">Logout</a>
                <a href="profile.php">Profile</a>
            </div>
        </div>
    </nav>