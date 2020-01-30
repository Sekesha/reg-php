<?php

session_start();

include_once "includes/db_connect.php";
include_once "includes/main_scripts.php";

$status = user_login($connect);
$header_for_user = auth();

$status_reg_auth = stat_user($status);

include_once "includes/header.php";

echo $status_reg_auth;

include_once "includes/footer.php";
?>
