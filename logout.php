<?php
session_start();
setcookie('login', '', time() - 600000);
session_unset();
session_destroy();
header("location: login.php");