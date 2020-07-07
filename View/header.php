<!DOCTYPE html>
<?php
include '../Config/CommonLib.php';
include '../Config/DatabaseConnection.php';
$databaseConnection = new DatabaseConnection();
$databaseConnection->openConnection();

$clib = new CommonLib();
?>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Brass Band System</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-3">
    <div class="container-fluid">        
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav">
                <a href="./Home.php" class="nav-item nav-link active">Home</a>
                <a href="./" class="nav-item nav-link">Equipments</a>
                <a href="./Pay1.php" class="nav-item nav-link">Membership</a>
                <a href="./Pay1.php" class="nav-item nav-link">Friends</a>
                <a href="./Pay1.php" class="nav-item nav-link">Uniforms</a>
                <a href="./Inquiries.php" class="nav-item nav-link">Music</a>
            </div>            
        </div>
    </div>    
</nav>