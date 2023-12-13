
<?php

require "../index.php";
require "./header.php";

// delete session


session_destroy();
header("Location: login.php");
