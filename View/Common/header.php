<?php
include '../../Config/CommonLib.php';
include '../../Config/DatabaseConnection.php';
$databaseConnection = new DatabaseConnection();
$databaseConnection->openConnection();

$clib = new CommonLib();
if (!isset($titlename)) {
    $titlename = "Brass Band System";
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title><?php echo $titlename; ?></title>
        <!-- custom:css -->
        <link rel="stylesheet" href="../Common/assets/css/custom.css" />
        <!-- plugins:css -->
        <link rel="stylesheet" href="../Common/assets/vendors/ti-icons/css/themify-icons.css">
        <link rel="stylesheet" href="../Common/assets/vendors/css/vendor.bundle.base.css">
        <!-- endinject -->
        <!-- Modal CSS -->
        <link rel="stylesheet" href="../Common/assets/modal-x/css/identimark-modal-min.css">
        <link rel="stylesheet" href="../Common/assets/modal-x/css/identimark-modal.css">
        <link rel="stylesheet" href="../Common/assets/modal-x/css/animate.min.css">
        <!-- Modal CSS -->
        <!-- Plugin css -->
        <link rel="stylesheet" href="../Common/assets/vendors/font-awesome/css/font-awesome.min.css" />
        <link rel="stylesheet" href="../Common/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
        <link rel="stylesheet" href="../Common/assets/vendors/jquery-file-upload/uploadfile.css">
        <link rel="stylesheet" href="../Common/assets/vendors/dropzone/dropzone.css">
        <link rel="stylesheet" href="../Common/assets/vendors/select2/select2.min.css">
        <link rel="stylesheet" href="../Common/assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
        <link rel="stylesheet" href="../Common/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
        <link rel="stylesheet" href="../Common/assets/vendors/summernote/dist/summernote-bs4.css">
        <!-- End plugin css-->
        <!-- inject:css -->
        <?php if (isset($_SESSION["loginreqclient"])) { ?>
            <link rel="stylesheet" href="../Common/assets/css/horizontal-layout-light/style.css">
        <?php } else { ?>
            <link rel="stylesheet" href="../Common/assets/css/vertical-layout-light/style.css">
        <?php } ?>




        <!-- endinject -->
        <link rel="shortcut icon" href="../Common/assets/images/favicon.png" />

        <style>
            .dataTables_wrapper .dataTable .btn, .dataTables_wrapper .dataTable .fc button, .fc .dataTables_wrapper .dataTable button, .dataTables_wrapper .dataTable .ajax-upload-dragdrop .ajax-file-upload, .ajax-upload-dragdrop .dataTables_wrapper .dataTable .ajax-file-upload, .dataTables_wrapper .dataTable .swal2-modal .swal2-buttonswrapper .swal2-styled, .swal2-modal .swal2-buttonswrapper .dataTables_wrapper .dataTable .swal2-styled, .dataTables_wrapper .dataTable .wizard > .actions a, .wizard > .actions .dataTables_wrapper .dataTable a {
                padding: 0.5rem 1rem;
                vertical-align: top;
            }
            .swal-text{
                text-align: center;
            }

            .dt-buttons button{
                padding: 5px;
                border-radius: 3px;
                font-size: small;
                background-color: rgba(245, 166, 35, 0.2);
                background-image: none;
                border-color: rgba(245, 166, 35, 0);
                position: relative;
                top: 40px;
            }



            .hr-sect {
                display: flex;
                flex-basis: 100%;
                align-items: center;
                color: rgba(0, 0, 0, 0.35);
                margin: 8px 0px;
            }
            .hr-sect::before,
            .hr-sect::after {
                content: "";
                flex-grow: 1;
                background: rgba(0, 0, 0, 0.35);
                height: 1px;
                font-size: 0px;
                line-height: 0px;
                margin: 0px 8px;
            }
            .select2{
                width: 100% !important;
            }

            .modal-mod{
                padding-bottom: 0 !important;
                padding-top: 0 !important;
                padding-left: 15px !important;
            }
            .modal-mod button.close{
                position: absolute;
                top: -17px;
                right: -14px;
            }
            .modal-mod button.close li.fa-times-circle{
                color: white;
            }

            .modal-mod-pic{
                background: url(../Common/assets/images/cust1.jpg);
                background-size: 100% 100%;
                background-repeat: no-repeat;
            }

            .modal-mod-pic div.separate{
                background: url(../Common/assets/images/shape.png);
                position: absolute;
                width: 45%;
                height: 100%;
                top: 0;
                z-index: 11111;
                background-size: 100% 100%;
                background-repeat: no-repeat;
                right: -1px;
            }

            .modal-mod-footer li.fa-info-circle{
                color: dimgrey;
            }

            .modal-mod-footer p{
                float: right;
                color: dimgrey;
                width: 90%;
                font-size: 12px;
            }

            .dropzone{
                min-height: 50px !important;
            }

            .select2-container--default .select2-selection--multiple .select2-selection__choice{
                background: #248afd !important;
            }
            .pac-container{
                z-index: 9999;
            }

        </style>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    </head>
