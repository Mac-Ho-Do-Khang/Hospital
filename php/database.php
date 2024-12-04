<?php
$db_server = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "hospitala";
$connection = "";

$tb_users = "users";
$tb_patient = "patient";
$tb_employee = "employee";

try {
    $connection = mysqli_connect($db_server, $db_user, $db_password, $db_name);
} catch (mysqli_sql_exception) {
    echo "Could not connect to database";
}
// if ($connection) echo "Connected to database";
