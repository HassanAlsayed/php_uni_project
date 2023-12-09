<?php

require "../index.php";
require "./header.php";

if (isset($_POST["submit"])) {
    echo $_POST['username'];
}

?>

<div class="min-h-[calc(100vh-80px)] flex items-center justify-center flex-col">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" class="rounded-lg border bg-card mt-2 text-card-foreground shadow-sm max-w-xl w-full mx-auto" data-v0-t="card">
        <div class="flex flex-col space-y-1.5 p-2">
            <h3 class="font-semibold tracking-tight text-3xl text-center">Register</h3>
            <p class="text-sm text-muted-foreground text-center">
                Please enter your details to create an account.
            </p>
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
                <input name="confirm_password" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" id="confirm-password" placeholder="Confirm your password" required="" type="password">
            </div>
        </div>
        <div class="flex items-center p-2">
            <input type="submit" name="submit" class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 w-full"></input>
        </div>
    </form>
    <a class="block text-center" href="login.php">Already have an account? Login</a>
</div>