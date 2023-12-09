<?php

$conn = mysqli_connect(getenv('DB_HOST'), getenv('DB_USERNAME'), getenv('DB_PASSWORD'), getenv('DB_NAME'));

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
