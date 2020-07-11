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


if ($_POST["serviceFlag"] == "USERLOGIN") {
    $username = $clib->input("username");
    $password = $clib->input("passwrd");
    $encPassword = password_hash($password, PASSWORD_DEFAULT);
    $query = "SELECT * FROM users where username='$username' and status=1";
    $result = $databaseConnection->openConnection()->query($query);
    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row['passwrd'])) {
            $_SESSION['username'] = $row['username'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['fullName'] = $row['full_name'];
            $_SESSION['user_id'] = $row['user_id'];
            $curtime = date("Y-m-d H:i:s");
            $userIdh = $row['user_id'];
            $databaseConnection->executeQuery("delete from users where passwrd='0'", $username . " logged into system");
            header("Location:../View/SYS/Notifications.php");
        } else {
            $databaseConnection->executeQuery("delete from users where passwrd='0'", $username . " tried to login");
            $clib->add_flash_msg(Messages::$userLoginErrorMsg, CommonLib::MSG_ERR);
            header("Location:../View/SYS/SysLogin.php");
        }
    } else {
        $clib->add_flash_msg(Messages::$userLoginErrorMsg, CommonLib::MSG_ERR);
        $databaseConnection->executeQuery("delete from users where passwrd='0'", $username . " tried to login");
        header("Location:../View/SYS/SysLogin.php");
    }
}


//Add new USER
if ($serviceFlag == "ADDNEWUSER") {
    $username = $clib->input("username");
    $passwrd = $clib->input("passwrd");
    $encPassword = password_hash($passwrd, PASSWORD_DEFAULT);
    $full_name = $clib->input("full_name");
    $email = $clib->input("email");
    $created = $databaseConnection->getTransactionDate();

    $sqlQuery = "INSERT INTO users (username,passwrd,full_name,email,status,created) VALUES('$username','$encPassword','$full_name','$email','1','$created')";
    $result = $databaseConnection->executeQuery($sqlQuery, $username . " User Added " . $serviceFlag);
    $clib->add_flash_msg(Messages::$dataSaveSuccessMsg, CommonLib::MSG_OK);
    header("Location:../View/SYS/Users.php");
}

//Delete USER
if ($serviceFlag == "DELUSER") {
    $user_id = $clib->input("user_id");
    $result = $databaseConnection->executeQuery("UPDATE users SET status='0' WHERE user_id='$user_id'", $user_id . " User Deleted! " . $serviceFlag);
    $clib->add_flash_msg(Messages::$dataDeleteSuccessMsg, CommonLib::MSG_OK);
    header("Location:../View/SYS/Users.php");
}