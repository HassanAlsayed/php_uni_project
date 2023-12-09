<?php
$dotenvFile = __DIR__ . '/.env';

if (file_exists($dotenvFile)) {
    $lines = file($dotenvFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        putenv($line);
    }
} else {
    die('.env file not found');
}
