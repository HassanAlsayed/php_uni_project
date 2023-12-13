<?php

include "../index.php";
include "../config/database.php";
include "./header.php";

$user_id = $_GET['user_id'];
$role = $_GET['role'];

if ($role === "admin" || $role === "secretary") {
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

    $existingValues = [
        'username' => $row['username'] ?? '',
        'name' => $row['name'] ?? '',
        'specialization' => $row['specialization'] ?? '',
        'contact_number' => $row['contact_number'] ?? '',
        'other_details' => $row['other_details'] ?? '',
    ];
} else {
    echo "User not found";
}

if (isset($_POST['submit'])) {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $contact_number = filter_input(INPUT_POST, 'contact_number', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $other_details = filter_input(INPUT_POST, 'other_details', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $sql = "UPDATE users SET username = '$username' WHERE user_id = $user_id";

    if ($role == 'doctor') {
        $specialization = filter_input(INPUT_POST, 'specialization', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $sql = "UPDATE doctors SET name = '$name', specialization = '$specialization', contact_number = '$contact_number', other_details = '$other_details' WHERE user_id = $user_id";

        if ($conn->query($sql) === TRUE) {
            echo "Updated";
        }
    } else {
        $sql = "UPDATE adminssecretaries SET name = '$name', contact_number = '$contact_number', other_details = '$other_details' WHERE user_id = $user_id";

        if ($conn->query($sql) === TRUE) {
            echo "Updated";
        }
    }

    header("Location: user_details.php?user_id=$user_id&role=$role");
}

?>

<div class="container mx-auto">

    <h2 class="text-2xl font-semibold mb-4">User Information Form</h2>

    <?php
    if ($role === "doctor") {
    ?>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
            <input type="text" name="username" placeholder="Username" class="mb-4 p-2 w-full border rounded" value="<?= $existingValues['username'] ?>">

            <input type="text" name="name" placeholder="Name" class="mb-4 p-2 w-full border rounded" value="<?= $existingValues['name'] ?? '' ?>">

            <input type="text" name="specialization" placeholder="Specialization" class="mb-4 p-2 w-full border rounded" value="<?= $existingValues['specialization'] ?? '' ?>">

            <input type="text" name="contact_number" placeholder="Contact Number" class="mb-4 p-2 w-full border rounded" value="<?= $existingValues['contact_number'] ?? '' ?>">

            <textarea name="other_details" placeholder="Other Details" class="mb-4 p-2 w-full border rounded"><?= $existingValues['other_details'] ?? '' ?></textarea>

            <button name="submit" type="submit" class="bg-blue-500 text-white p-2 rounded">Submit</button>
        </form>
    <?php
    } else {
    ?>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
            <input type="text" name="username" placeholder="Username" class="mb-4 p-2 w-full border rounded" value="<?= $existingValues['username'] ?>">

            <input type="text" name="name" placeholder="Name" class="mb-4 p-2 w-full border rounded" value="<?= $existingValues['name'] ?? '' ?>">

            <input type="text" name="contact_number" placeholder="Contact Number" class="mb-4 p-2 w-full border rounded" value="<?= $existingValues['contact_number'] ?? '' ?>">

            <textarea name="other_details" placeholder="Other Details" class="mb-4 p-2 w-full border rounded"><?= $existingValues['other_details'] ?? '' ?></textarea>

            <button name="submit" type="submit" class="bg-blue-500 text-white p-2 rounded">Submit</button>
        </form>
    <?php
    }
    ?>

</div>