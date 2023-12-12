<?php

require "../index.php";
require "./header.php";


if ($_SESSION['role'] != 'admin') {
    header("Location: ./login.php");
}

$sql = "SELECT username, user_id, role FROM users";

$result = $conn->query($sql);


if ($result->num_rows > 0) {
    $users = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $users = [];
}

?>

<div class="flex flex-col w-full min-h-screen p-4">
    <header class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold">Users Management</h1>
        <a href="add_user.php" class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 hover:bg-primary/90 h-10 px-4 py-2 bg-blue-500 text-white">
            Add new user
        </a>
    </header>
    <div class="flex items-center w-full gap-4 mb-6">
        <form class="flex-1">
            <div class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="absolute left-2.5 top-2.5 h-4 w-4 text-gray-500">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.3-4.3"></path>
                </svg>
                <input class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 pl-8" placeholder="Search User..." type="search" />
            </div>
        </form>
    </div>
    <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
        <?php foreach ($users as $user) : ?>
            <div class="rounded-lg border bg-card text-card-foreground shadow-sm" data-v0-t="card">
                <div class="p-6">
                    <div class="flex items-center space-x-2">
                        <div>
                            <h2 class="text-lg font-semibold"><?= $user['username'] ?></h2>
                        </div>
                    </div>
                    <p class="mt-2 text-gray-500"><?= $user['role'] ?></p>
                    <a class="mt-2 underline text-blue-500" href="./user_details.php?user_id=<?= $user['user_id'] ?>&role=<?= $user['role'] ?>">
                        View Details
                    </a>
                    <form method="post" action="./delete_user.php" onsubmit="return confirm('Are you sure you want to delete this user?');">
                        <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
                        <input type="hidden" name="role" value="<?= $user['role'] ?>">
                        <button type="submit" class="mt-2 underline text-red-500" name="delete_user">Delete</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</div>
</div>