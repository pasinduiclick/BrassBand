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


//ADD new member
if ($serviceFlag == "ADDNEWMEM") {

    $name = $clib->input("name");
    $email = $clib->input("email");
    $address = $clib->input("address");
    $phone = $clib->input("phone");
    $parents_name = $clib->input("parents_name");
    $parents_email = $clib->input("parents_email");
    $parents_phone = $clib->input("parents_phone");
    $parents_mobile = $clib->input("parents_mobile");
    $membership_type = $clib->input("membership_type");
    $membership_category = $clib->input("membership_category");
    $date_joined = $clib->input("date_joined");
    $date_left = $clib->input("date_left");
    $created = $databaseConnection->getTransactionDate();

    $sqlQuery = "INSERT INTO membership (name,email,address,phone,parents_name,parents_email,parents_phone,parents_mobile,membership_type,membership_category,date_joined,date_left,status,created) VALUES('$name','$email','$address','$phone','$parents_name','$parents_email','$parents_phone','$parents_mobile','$membership_type','$membership_category','$date_joined','$date_left','1','$created')";
    $result = $databaseConnection->executeQuery($sqlQuery, $name . " New membership added " . $serviceFlag);
    $clib->add_flash_msg(Messages::$dataSaveSuccessMsg, CommonLib::MSG_OK);
    header("Location:../View/SYS/Members.php");
}

//Update member
if ($serviceFlag == "EDITMEM") {

    $mem_id = $clib->input("mem_id");
    $name = $clib->input("name");
    $email = $clib->input("email");
    $address = $clib->input("address");
    $phone = $clib->input("phone");
    $parents_name = $clib->input("parents_name");
    $parents_email = $clib->input("parents_email");
    $parents_phone = $clib->input("parents_phone");
    $parents_mobile = $clib->input("parents_mobile");
    $membership_type = $clib->input("membership_type");
    $membership_category = $clib->input("membership_category");
    $date_joined = $clib->input("date_joined");
    $date_left = $clib->input("date_left");

    $sqlQuery = "UPDATE membership SET name='$name',email='$email',address='$address',phone='$phone',parents_name='$parents_name',parents_email='$parents_email',parents_phone='$parents_phone',parents_mobile='$parents_mobile',membership_type='$membership_type',membership_category='$membership_category',date_joined='$date_joined',date_left='$date_left' WHERE mem_id='$mem_id'";
    $result = $databaseConnection->executeQuery($sqlQuery, $name . " Update membership details " . $serviceFlag);
    $clib->add_flash_msg(Messages::$dataUpdateSuccessMsg, CommonLib::MSG_OK);
    header("Location:../View/SYS/Members.php");
}

//Delete membership
if ($serviceFlag == "DELMEMBER") {
    $mem_id = $clib->input("mem_id");
    $result = $databaseConnection->executeQuery("UPDATE membership SET status='0' WHERE mem_id='$mem_id'", $mem_id . " Membership Deleted! " . $serviceFlag);
    $clib->add_flash_msg(Messages::$dataDeleteSuccessMsg, CommonLib::MSG_OK);
    header("Location:../View/SYS/Members.php");
}

//Add friend
if ($serviceFlag == "ADDNEWFRIEND") {

    $name = $clib->input("name");
    $email = $clib->input("email");
    $notes = $clib->input("notes");
    $created = $databaseConnection->getTransactionDate();
    $mem_id = $clib->input("mem_id");

    $sqlQuery = "INSERT INTO friends (name,email,notes,status,created,mem_id) VALUES('$name','$email','$notes','1','$created','$mem_id')";
    $result = $databaseConnection->executeQuery($sqlQuery, $name . " New membership added " . $serviceFlag);
    $clib->add_flash_msg(Messages::$dataSaveSuccessMsg, CommonLib::MSG_OK);
    header("Location:../View/SYS/Friends.php");
}

//Delete Friend
if ($serviceFlag == "DELFRIEND") {
    $friend_id = $clib->input("friend_id");
    $result = $databaseConnection->executeQuery("UPDATE friends SET status='0' WHERE friend_id='$friend_id'", $friend_id . " Friend Deleted! " . $serviceFlag);
    $clib->add_flash_msg(Messages::$dataDeleteSuccessMsg, CommonLib::MSG_OK);
    header("Location:../View/SYS/Friends.php");
}