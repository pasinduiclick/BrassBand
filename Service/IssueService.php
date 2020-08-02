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

//Issue Instruments
if ($serviceFlag == "ISSUEINS") {

    $ref_number = $clib->input("ref_number");
    $mem_id = $clib->input("mem_id");
    $issue_date = $clib->input("issue_date");
    $return_date = $clib->input("return_date");
    $created = $databaseConnection->getTransactionDate();

    $arra = array_keys($_POST['ins_id']);
    for ($index = 0; $index < count($arra); $index++) {

        $ins_id = $_POST['ins_id'][$arra[$index]];
        $qty = $_POST['qty'][$arra[$index]];

        $sqlQuery = "INSERT INTO issue_ins (ref_number,ins_id,mem_id,qty,issue_date,return_date,status,created) VALUES('$ref_number','$ins_id','$mem_id','$qty','$issue_date','$return_date','1','$created')";
        $result = $databaseConnection->executeQuery($sqlQuery, $ref_number . " Instrument issued. " . $serviceFlag);

        $sqlQuery1 = "INSERT INTO notifications (not_details,ref_number,issue_date,return_date,member,status,type,id) VALUES('Instrument Issued','$ref_number','$issue_date','$return_date','$mem_id','1','INS','$ins_id')";
        $result1 = $databaseConnection->executeQuery($sqlQuery1, $ref_number . " Notification Added " . $serviceFlag);
    }

    $clib->add_flash_msg(Messages::$dataSaveSuccessMsg, CommonLib::MSG_OK);
    $databaseConnection->sendEmailNotification($ref_number,$mem_id,$return_date);        
    header("Location:../View/SYS/Issue_INS.php");
}

//Issue Uniforms
if ($serviceFlag == "ISSUEUNI") {

    $ref_number = $clib->input("ref_number");
    $mem_id = $clib->input("mem_id");
    $issue_date = $clib->input("issue_date");
    $return_date = $clib->input("return_date");
    $created = $databaseConnection->getTransactionDate();

    $arra = array_keys($_POST['uniform_id']);
    for ($index = 0; $index < count($arra); $index++) {

        $uniform_id = $_POST['uniform_id'][$arra[$index]];
        $qty = $_POST['qty'][$arra[$index]];

        $sqlQuery = "INSERT INTO issue_uniform (ref_number,uniform_id,mem_id,qty,issue_date,return_date,status,created) VALUES('$ref_number','$uniform_id','$mem_id','$qty','$issue_date','$return_date','1','$created')";
        $result = $databaseConnection->executeQuery($sqlQuery, $ref_number . " Uniform issued. " . $serviceFlag);

        $sqlQuery1 = "INSERT INTO notifications (not_details,ref_number,issue_date,return_date,member,status,type,id) VALUES('Uniform Issued','$ref_number','$issue_date','$return_date','$mem_id','1','UNI','$uniform_id')";
        $result1 = $databaseConnection->executeQuery($sqlQuery1, $ref_number . " Notification Added " . $serviceFlag);
    }

    $clib->add_flash_msg(Messages::$dataSaveSuccessMsg, CommonLib::MSG_OK);
    $databaseConnection->sendEmailNotification($ref_number,$mem_id,$return_date);       
    header("Location:../View/SYS/Issue_UNI.php");
}

//Instrument Return
if ($serviceFlag == "INSRETURN") {
    $ref_number = $clib->input("ref_number");
    $result = $databaseConnection->executeQuery("UPDATE issue_ins SET status='2' WHERE ref_number='$ref_number'", $ref_number . " Instrument returned " . $serviceFlag);
    $result1 = $databaseConnection->executeQuery("UPDATE notifications SET status='0' WHERE ref_number='$ref_number'", $ref_number . " Notification Cleared " . $serviceFlag);
    $clib->add_flash_msg(Messages::$dataSaveSuccessMsg, CommonLib::MSG_OK);
    header("Location:../View/SYS/Issue_INS.php");
}

//Uniform Return
if ($serviceFlag == "UNIRETURN") {
    $ref_number = $clib->input("ref_number");
    $result = $databaseConnection->executeQuery("UPDATE issue_uniform SET status='2' WHERE ref_number='$ref_number'", $ref_number . " Uniform returned " . $serviceFlag);
    $result1 = $databaseConnection->executeQuery("UPDATE notifications SET status='0' WHERE ref_number='$ref_number'", $ref_number . " Notification Cleared " . $serviceFlag);
    $clib->add_flash_msg(Messages::$dataSaveSuccessMsg, CommonLib::MSG_OK);
    header("Location:../View/SYS/Issue_UNI.php");
}

//Clear Notification
if ($serviceFlag == "CLEARNOTIFY") {
    $ref_number = $clib->input("ref_number");
    $result = $databaseConnection->executeQuery("UPDATE notifications SET status='0' WHERE ref_number='$ref_number'", $ref_number . " Notification Cleared " . $serviceFlag);
    $clib->add_flash_msg(Messages::$dataDeleteSuccessMsg, CommonLib::MSG_OK);
    header("Location:../View/SYS/Notifications.php");
}