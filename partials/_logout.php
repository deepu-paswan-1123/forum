<?php
session_start();
echo "wait you are log out...";
session_destroy();
header("Location:/forum/index.php");
?>