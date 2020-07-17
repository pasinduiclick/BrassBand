<?php

include '../Config/CommonLib.php';
include '../Config/DatabaseConnection.php';
include '../Config/Messages.php';
require '../Config/Upload.php';
$databaseConnection = new DatabaseConnection();
$databaseConnection->openConnection();

// common lib
$clib = new CommonLib();

// csrf implimenttation
$clib->csrf_verify();

// login required
$clib->login_reqired();

if (isset($_POST['serviceFlag'])) {
    $serviceFlag = $_POST['serviceFlag'];
} else {
    $serviceFlag = $_GET['serviceFlag'];
}

if ($serviceFlag == "ADDEMAILCONFIG") {

    $username = $clib->input("username");
    $passwrd = $clib->input("passwrd");
    $host = $clib->input("host");
    $portnum = $clib->input("portnum");
    $updated = $databaseConnection->getTransactionDate();

    $result = $databaseConnection->executeQuery("delete from emailconfig", "SMTP data cleared." . $serviceFlag);
    $sqlQuery = "INSERT INTO emailconfig (username,passwrd,host,portnum,updated) VALUES('$username','$passwrd','$host','$portnum','$updated')";
    $result = $databaseConnection->executeQuery($sqlQuery, $username . " SMTP updated." . $serviceFlag);
    $clib->add_flash_msg(Messages::$dataSaveSuccessMsg, CommonLib::MSG_OK);
     header("Location:../View/SYS/emailConfig.php");
}

