<?php
session_start();

$_SESSION = array();  //or session_unset();
session_destroy();

header("Location: index.php"); 
exit();