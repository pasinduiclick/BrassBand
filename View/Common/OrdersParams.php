<?php

$country = "";
$country_code = "";
$ETA_MSG = "";

if (isset($_SESSION['country'])) {
    $country = $_SESSION['country'];
} else if (isset($_POST['country'])) {
    $country = $_POST['country'];
}


if ($country == CommonLib::COUNTRY_AU) {
    $country_code = "AU";
    $ETA_MSG = "ETA 7 Days";
} else {
    $country_code = "NZ";
    $ETA_MSG = "ETA 2 Days";
}
$ref_number = "";
$datetime = date("dmy");
$query1 = "SELECT MAX(order_id) AS MAXID from orders";
$result1 = $databaseConnection->openConnection()->query($query1);
while ($row1 = $result1->fetch_assoc()) {
    $ref_number = "O" . $country_code . $datetime . $row1['MAXID'];
}

?>