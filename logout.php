<?php
session_start();
$_SESSION['uid'] = "";
session_destroy();
header('Location:index.html');
?>