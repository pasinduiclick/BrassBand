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


//ADD new account
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
    $membership_category=$clib->input("membership_category");
    $date_joined = $clib->input("date_joined");
    $date_left = $clib->input("date_left");
    $created = $databaseConnection->getTransactionDate();

    $sqlQuery = "INSERT INTO membership (name,email,address,phone,parents_name,parents_email,parents_phone,parents_mobile,membership_type,membership_category,date_joined,date_left,status,created) VALUES('$name','$email','$address','$phone','$parents_name','$parents_email','$parents_phone','$parents_mobile','$membership_type','$membership_category','$date_joined','$date_left','1','$created')";
    $result = $databaseConnection->executeQuery($sqlQuery, $business . " Added to Accounts");
    $clib->add_flash_msg(Messages::$dataSaveSuccessMsg, CommonLib::MSG_OK);
    header("Location:../View/SYS/Members.php");
}

//Update account
if ($serviceFlag == "UPDATEACC") {

    $acc_id = $clib->input("acc_id");
    $business = $clib->input("business");
    $postAddress = $clib->input("postAddress");
    $phyAddress = $clib->input("phyAddress");
    $country = $clib->input("country");
    $contact = $clib->input("contact");
    $phone = $clib->input("phone");
    $mobile = $clib->input("mobile");
    $setupfee = $clib->input("setupfee");
    $frphand = $clib->input("frphand");
    $notes = $clib->input("notes");
    $email = $clib->input("email");
    $xeroapi = $clib->input("xeroapi");
    $acc_term = $clib->input("acc_term");
    $street = $clib->input("street");
    $postal_code = $clib->input("postal_code");
    $suberb = $clib->input("suberb");
    $state = $clib->input("state");
    $insurance_approved = $clib->input("insurance_approved");
    $insurance_value = $clib->input("insurance_value");
    $created = $databaseConnection->getTransactionDate();

    if ($photo_url != "") {
        $sqlQuery = "UPDATE accounts SET business_name='$business',post_address='$postAddress',phy_address='$phyAddress',country='$country',contact='$contact',phone='$phone',mobile='$mobile',setup_fee='$setupfee',frphand='$frphand',notes='$notes',logo='$photo_url',email='$email',xeroapi='$xeroapi',acc_term='$acc_term',street='$street',postal_code='$postal_code',suberb='$suberb',state='$state',insurance_approved='$insurance_approved',insurance_value='$insurance_value' WHERE acc_id='$acc_id'";
    } else {
        $sqlQuery = "UPDATE accounts SET business_name='$business',post_address='$postAddress',phy_address='$phyAddress',country='$country',contact='$contact',phone='$phone',mobile='$mobile',setup_fee='$setupfee',frphand='$frphand',notes='$notes',email='$email',xeroapi='$xeroapi',acc_term='$acc_term',street='$street',postal_code='$postal_code',suberb='$suberb',state='$state',insurance_approved='$insurance_approved',insurance_value='$insurance_value' WHERE acc_id='$acc_id'";
    }

    $result = $databaseConnection->executeQuery($sqlQuery, $business . " Account updated");
    $clib->add_flash_msg(Messages::$dataUpdateSuccessMsg, CommonLib::MSG_OK);
    header("Location:../View/Admin/accounts.php");
}

//TODO
if ($serviceFlag == "DELACCAJAX") {
    $acc_id = $clib->input("acc_id");
    $result = $databaseConnection->executeQuery("update accounts set status='0' where acc_id='$acc_id'", $acc_id . " Account ID Deleted !");
    $clib->add_flash_msg(Messages::$dataDeleteSuccessMsg, CommonLib::MSG_OK);
    header("Location:../View/Admin/accounts.php");
}

if ($serviceFlag == "ADDACCTERMS") {
    $term_name = $clib->input("term_name");
    $status = $clib->input("status");
    $created = $databaseConnection->getTransactionDate();

    $result = $databaseConnection->executeQuery("INSERT INTO acc_terms (term_name,status,created) VALUES('$term_name','1','$created')", $term_name . " Account Term created !");
    $clib->add_flash_msg(Messages::$dataSaveSuccessMsg, CommonLib::MSG_OK);
    header("Location:../View/Admin/AccountTerms.php");
}


if ($serviceFlag == "DELACCTERM") {
    $acc_term_id = $clib->input("acc_term_id");
    $result = $databaseConnection->executeQuery("UPDATE acc_terms SET status='0' WHERE acc_term_id='$acc_term_id'", $acc_term_id . " Account term Deleted !");
    $clib->add_flash_msg(Messages::$dataDeleteSuccessMsg, CommonLib::MSG_OK);
    header("Location:../View/Admin/AccountTerms.php");
}

if ($serviceFlag == "ADDACCCATEGORY") {
    $category_name = $clib->input("category_name");
    $status = $clib->input("status");
    $created = $databaseConnection->getTransactionDate();

    $result = $databaseConnection->executeQuery("INSERT INTO acc_category (category_name,status,created) VALUES('$category_name','1','$created')", $category_name . " Account Category created !");
    $clib->add_flash_msg(Messages::$dataSaveSuccessMsg, CommonLib::MSG_OK);
    header("Location:../View/Admin/AccountTerms.php");
}

if ($serviceFlag == "DELACCCATEGORY") {
    $acc_cat_id = $clib->input("acc_cat_id");
    $result = $databaseConnection->executeQuery("UPDATE acc_category SET status='0' WHERE acc_cat_id='$acc_cat_id'", $acc_cat_id . " Account Category Deleted !");
    $clib->add_flash_msg(Messages::$dataDeleteSuccessMsg, CommonLib::MSG_OK);
    header("Location:../View/Admin/AccountTerms.php");
}