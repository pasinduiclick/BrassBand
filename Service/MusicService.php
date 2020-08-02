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


//ADD new Music
if ($serviceFlag == "ADDNEWMUSIC") {

    $name = $clib->input("name");
    $genre = $clib->input("genre");
    $composer = $clib->input("composer");
    $arranger = $clib->input("arranger");
    $file_number = $clib->input("file_number");
    $created = $databaseConnection->getTransactionDate();

    //File Upload process
    $target_dir = "music_files/";
    $target_file = $target_dir . basename($_FILES["music_file"]["name"]);
    $fileExt = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // Allow pdf file formats
    if ($fileExt != "pdf") {
        echo "Sorry, only PDF files are allowed.";
        $clib->add_flash_msg("Sorry, only PDF files are allowed.", CommonLib::MSG_ERR);
        header("Location:../View/SYS/Music.php");
    } else {
        $target_file = $target_dir . $file_number . ".pdf";
        move_uploaded_file($_FILES["music_file"]["tmp_name"], $target_file);
        $fileName = $target_file;
        $sqlQuery = "INSERT INTO music (name,genre,composer,arranger,file_number,status,created,music_file) VALUES('$name','$genre','$composer','$arranger','$file_number','1','$created','$fileName')";
        $result = $databaseConnection->executeQuery($sqlQuery, $name . " New Music added " . $serviceFlag);
        $clib->add_flash_msg(Messages::$dataSaveSuccessMsg, CommonLib::MSG_OK);
        header("Location:../View/SYS/Music.php");
    }
}

//Update Music
if ($serviceFlag == "EDITMUSIC") {

    $music_id = $clib->input("music_id");
    $name = $clib->input("name");
    $genre = $clib->input("genre");
    $composer = $clib->input("composer");
    $arranger = $clib->input("arranger");
    $file_number = $clib->input("file_number");

    //File Upload process
    $target_dir = "music_files/";
    $target_file = $target_dir . basename($_FILES["music_file"]["name"]);
    $fileExt = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // Allow pdf file formats
    if ($fileExt != "pdf") {
        echo "Sorry, only PDF files are allowed.";
        $clib->add_flash_msg("Sorry, only PDF files are allowed.", CommonLib::MSG_ERR);
        header("Location:../View/SYS/Music.php");
    } else {
        $target_file = $target_dir . $file_number . ".pdf";
        move_uploaded_file($_FILES["music_file"]["tmp_name"], $target_file);
        $fileName = $target_file;
        $sqlQuery = "UPDATE music SET name='$name',genre='$genre',composer='$composer',arranger='$arranger',file_number='$file_number',music_file='$fileName' WHERE music_id='$music_id'";
        $result = $databaseConnection->executeQuery($sqlQuery, $name . " Update music details " . $serviceFlag);
        $clib->add_flash_msg(Messages::$dataUpdateSuccessMsg, CommonLib::MSG_OK);
        header("Location:../View/SYS/Music.php");
    }
}

//Delete Music
if ($serviceFlag == "DELMUSIC") {
    $music_id = $clib->input("music_id");
    $result = $databaseConnection->executeQuery("UPDATE music SET status='0' WHERE music_id='$music_id'", $music_id . " Music Deleted! " . $serviceFlag);
    $clib->add_flash_msg(Messages::$dataDeleteSuccessMsg, CommonLib::MSG_OK);
    header("Location:../View/SYS/Music.php");
}
