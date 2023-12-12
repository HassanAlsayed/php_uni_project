<?php

include "../index.php";
include "./header.php";

$error = "";

if (isset($_POST["submit"])) {
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];
    $role = $_POST["role"];

    if ($password !== $confirmPassword) {
        $error = "Passwords do not match.";
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";

        if ($conn->query($sql) === TRUE) {
            $user_id = $conn->insert_id;

            if ($role == "doctor") {
                $sql = "INSERT INTO doctors (user_id) VALUES ('$user_id')";
            } elseif ($role == "admin") {
                $sql = "INSERT INTO adminssecretaries (user_id) VALUES ('$user_id')";
            }

            if (isset($sql)) {
                if ($conn->query($sql) === TRUE) {
                    header("Location: users.php");
                } else {
                    $error = "Error inserting into doctors or adminssecretaries: " . $conn->error;
                }
            } else {
                header("Location: users.php");
            }
        } else {
            $error = "Error inserting into users: " . $conn->error;
        }
    }
}


?>

<div class="min-h-[calc(100vh-80px)] flex items-center justify-center flex-col">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" class="rounded-lg border bg-card mt-2 text-card-foreground shadow-sm max-w-xl w-full mx-auto" data-v0-t="card">
        <div class="flex flex-col space-y-1.5 p-2">
            <h3 class="font-semibold tracking-tight text-3xl text-center">Add user</h3>
        </div>
        <div class="px-6 py-2 space-y-4">
            <div class="space-y-2">
                <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="username">Username</label>
                <input name="username" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" id="username" placeholder="Enter your username" required="" type="text">
            </div>
            <div class="space-y-2">
                <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="password">Password</label>
                <input name="password" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" id="password" placeholder="Enter your password" required="" type="password">
            </div>
            <div class="space-y-2">
                <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="confirm-password">Confirm Password</label>
                <input name="confirmPassword" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" id="confirm-password" placeholder="Confirm your password" required="" type="password">
            </div>
            <div class="space-y-2">
                <select name="role" class="bg-blue-400 p-2 rounded">
                    <option value="doctor">Doctor</option>
                    <option value="secretary">
                        Secretary
                    </option>
                    <option value="admin">
                        Admin
                    </option>
                </select>
            </div>

        </div>
        <?php $error ? print "<div class='text-red-500 font-semibold text-center'>$error</div>" : "" ?>
        <div class="flex items-center p-2">
            <input type="submit" name="submit" class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 w-full"></input>
        </div>
    </form>
    <a class="block text-center" href="login.php">Already have an account? Login</a>
</div>