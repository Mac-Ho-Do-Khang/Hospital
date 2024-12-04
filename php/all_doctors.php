<?php
include 'database.php';

header("Content-Type: text/xml; charset=UTF-8");

$query = "SELECT CODE, CONCAT(FIRST_NAME, ' ', LAST_NAME) FULL_NAME FROM $tb_employee where JOB_TYPE='D';";
$result = mysqli_query($connection, $query);

echo "<doctors>";

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<doctor><code>" . htmlspecialchars($row['CODE']) . "</code>";
        echo "<full_name>" . htmlspecialchars($row['FULL_NAME']) . "</full_name></doctor>";
    }
}

echo "</doctors>";
