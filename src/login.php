<?php

include "../index.php";
include "../config/database.php";

session_start();

if (isset($_POST['submit'])) {
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = $_POST["password"];
    $sql = "SELECT * FROM users WHERE username = '$username'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            $_SESSION["username"] = $username;
            $_SESSION["user_id"] = $row["user_id"];
            $_SESSION["role"] = $row["role"];

            header("Location: ./home.php");
        } else {
            echo "Invalid password";
        }
    } else {
        echo "Invalid username";
    }
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
            </ul>
        </div>
    </nav>
    <div class="min-h-[calc(100vh-80px)] flex items-center justify-center flex-col">
        <form action="<?php echo  $_SERVER["PHP_SELF"] ?>" method="post" class="rounded-lg border bg-card text-card-foreground shadow-sm max-w-sm mx-auto" data-v0-t="card">
            <div class="flex flex-col space-y-1.5 p-6">
                <h3 class="font-semibold tracking-tight text-3xl text-center">Login</h3>
                <p class="text-sm text-muted-foreground text-center">Please enter your username and password to login.</p>
            </div>
            <div class="p-6 space-y-4">
                <div class="space-y-2">
                    <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="username">
                        Username
                    </label>
                    <input name="username" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" id="username" placeholder="Enter your username" required="" type="text" />
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="password">
                        Password
                    </label>
                    <input name="password" placeholder="Password" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" id="password" required="" type="password" />
                </div>
            </div>
            <div class="flex items-center p-6">
                <input type="submit" name="submit" class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2 w-full bg-red-100">
                </input>
            </div>
            <a href="register.php">Register a user</a>
        </form>
    </div>