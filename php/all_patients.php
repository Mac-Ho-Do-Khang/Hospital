<?php
include 'database.php';

header("Content-Type: text/xml; charset=UTF-8");

$query = "SELECT CODE, CONCAT(FIRST_NAME, ' ', LAST_NAME) FULL_NAME FROM $tb_patient;";
$result = mysqli_query($connection, $query);

echo "<patients>";

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<patient><code>" . htmlspecialchars($row['CODE']) . "</code>";
        echo "<full_name>" . htmlspecialchars($row['FULL_NAME']) . "</full_name></patient>";
    }
}

echo "</patients>";
