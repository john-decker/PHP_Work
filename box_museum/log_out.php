<?php
session_start();
$_SESSION = array();
session_destroy();
header("Location: ./box_museum.php");
?>