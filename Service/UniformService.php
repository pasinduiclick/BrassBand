<?php

/**
 * Description of Members
 *
 * @author Pasindu
 */
//error_reporting(0);

if (isset($_POST['serviceFlag'])) {
    $serviceFlag = $_POST['serviceFlag'];
} else {
    $serviceFlag = $_GET['serviceFlag'];
}
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


//ADD new Uniforms
if ($serviceFlag == "ADDNEWUNI") {

    $type = $clib->input("type");
    $sizes = $clib->input("sizes");
    $id_marking = $clib->input("id_marking");
    $created = $databaseConnection->getTransactionDate();

    $sqlQuery = "INSERT INTO Uniforms (type,sizes,id_marking,status,created) VALUES('$type','$sizes','$id_marking','1','$created')";
    $result = $databaseConnection->executeQuery($sqlQuery, $type . " New Uniform added " . $serviceFlag);
    $clib->add_flash_msg(Messages::$dataSaveSuccessMsg, CommonLib::MSG_OK);
    header("Location:../View/SYS/Uniforms.php");
}

//Update Uniforms
if ($serviceFlag == "EDITUNI") {

    $uniform_id = $clib->input("uniform_id");
    $type = $clib->input("type");
    $sizes = $clib->input("sizes");
    $id_marking = $clib->input("id_marking");

    $sqlQuery = "UPDATE Uniforms SET type='$type',sizes='$sizes',id_marking='$id_marking' WHERE uniform_id='$uniform_id'";
    $result = $databaseConnection->executeQuery($sqlQuery, $type . " Update Uniforms details " . $serviceFlag);
    $clib->add_flash_msg(Messages::$dataUpdateSuccessMsg, CommonLib::MSG_OK);
    header("Location:../View/SYS/Uniforms.php");
}

//Delete Uniforms
if ($serviceFlag == "DELUNI") {
    $uniform_id = $clib->input("uniform_id");
    $result = $databaseConnection->executeQuery("UPDATE Uniforms SET status='0' WHERE uniform_id='$uniform_id'", $uniform_id . " Uniform Deleted! " . $serviceFlag);
    $clib->add_flash_msg(Messages::$dataDeleteSuccessMsg, CommonLib::MSG_OK);
    header("Location:../View/SYS/Uniforms.php");
}
