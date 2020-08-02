<?php

include '../Config/CommonLib.php';
include '../Config/DatabaseConnection.php';
include '../Config/Messages.php';
include '../Config/EmailHelper.php';

if (isset($_POST['serviceFlag'])) {
    $serviceFlag = $_POST['serviceFlag'];
} else {
    $serviceFlag = $_GET['serviceFlag'];
}

$databaseConnection = new DatabaseConnection();
$databaseConnection->openConnection();

// common lib
$clib = new CommonLib();

// email helper
$emailHelper = new EmailHelper(TRUE);
// csrf implimenttation
$clib->csrf_verify();


//Add new Instrument Type
if ($serviceFlag == "ADDINSTYPE") {
    $instype = $clib->input("instype");
    $created = $databaseConnection->getTransactionDate();

    $sqlQuery = "INSERT INTO instype (instype,status,created) VALUES('$instype','1','$created')";
    $result = $databaseConnection->executeQuery($sqlQuery, $instype . " Instrument Type Added " . $serviceFlag);
    $clib->add_flash_msg(Messages::$dataSaveSuccessMsg, CommonLib::MSG_OK);
    header("Location:../View/SYS/MasterData.php");
}

//Delete Instrument Type
if ($serviceFlag == "DELINSTYPE") {
    $id = $clib->input("id");
    $result = $databaseConnection->executeQuery("UPDATE instype SET status='0' WHERE id='$id'", $id . " Instrument Type Deleted! " . $serviceFlag);
    $clib->add_flash_msg(Messages::$dataDeleteSuccessMsg, CommonLib::MSG_OK);
    header("Location:../View/SYS/MasterData.php");
}

//Add new Uniform Category
if ($serviceFlag == "ADDUNICAT") {
    $created = $databaseConnection->getTransactionDate();
    $category_name = $clib->input("category_name");
    $type = $clib->input("type");

    $sqlQuery = "INSERT INTO unicat (category_name,type,status,created) VALUES('$category_name','$type','1','$created')";
    $result = $databaseConnection->executeQuery($sqlQuery, $type . " Uniform Category Added " . $serviceFlag);
    $clib->add_flash_msg(Messages::$dataSaveSuccessMsg, CommonLib::MSG_OK);
    header("Location:../View/SYS/MasterData.php");
}

//Delete Uniform Category
if ($serviceFlag == "DELUNICAT") {
    $unicatid = $clib->input("unicatid");
    $result = $databaseConnection->executeQuery("UPDATE unicat SET status='0' WHERE unicatid='$unicatid'", $unicatid . " Uniform Category Deleted! " . $serviceFlag);
    $clib->add_flash_msg(Messages::$dataDeleteSuccessMsg, CommonLib::MSG_OK);
    header("Location:../View/SYS/MasterData.php");
}