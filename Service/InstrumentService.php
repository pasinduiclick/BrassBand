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


//ADD new Instrument
if ($serviceFlag == "ADDNEWINS") {

    $type = $clib->input("type");
    $make = $clib->input("make");
    $model = $clib->input("model");
    $serial = $clib->input("serial");
    $euphonium = $clib->input("euphonium");
    $mouthpiece = $clib->input("mouthpiece");
    $lyre = $clib->input("lyre");
    $cases = $clib->input("cases");
    $marching_strap = $clib->input("marching_strap");
    $created = $databaseConnection->getTransactionDate();

    $sqlQuery = "INSERT INTO instruments (type,make,model,serial,euphonium,mouthpiece,lyre,cases,marching_strap,status,created) VALUES('$type','$make','$model','$serial','$euphonium','$mouthpiece','$lyre','$cases','$marching_strap','1','$created')";
    $result = $databaseConnection->executeQuery($sqlQuery, $name . " New Instrument added " . $serviceFlag);
    $clib->add_flash_msg(Messages::$dataSaveSuccessMsg, CommonLib::MSG_OK);
    header("Location:../View/SYS/Instruments.php");
}

//Update Instrument
if ($serviceFlag == "EDITINS") {

    $ins_id = $clib->input("ins_id");
    $type = $clib->input("type");
    $make = $clib->input("make");
    $model = $clib->input("model");
    $serial = $clib->input("serial");
    $euphonium = $clib->input("euphonium");
    $mouthpiece = $clib->input("mouthpiece");
    $lyre = $clib->input("lyre");
    $cases = $clib->input("cases");
    $marching_strap = $clib->input("marching_strap");

    $sqlQuery = "UPDATE instruments SET type='$type',make='$make',model='$model',serial='$serial',euphonium='$euphonium',mouthpiece='$mouthpiece',lyre='$lyre',cases='$cases',marching_strap='$marching_strap' WHERE ins_id='$ins_id'";
    $result = $databaseConnection->executeQuery($sqlQuery, $model . " Update Instrument details " . $serviceFlag);
    $clib->add_flash_msg(Messages::$dataUpdateSuccessMsg, CommonLib::MSG_OK);
    header("Location:../View/SYS/Instruments.php");
}

//Delete Instruments
if ($serviceFlag == "DELINS") {
    $ins_id = $clib->input("ins_id");
    $result = $databaseConnection->executeQuery("UPDATE instruments SET status='0' WHERE ins_id='$ins_id'", $ins_id . " Instrument Deleted! " . $serviceFlag);
    $clib->add_flash_msg(Messages::$dataDeleteSuccessMsg, CommonLib::MSG_OK);
    header("Location:../View/SYS/Instruments.php");
}
