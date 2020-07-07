<?php

include '../../Config/CommonLib.php';
session_start();
$from = $_SESSION['from'];
if ($from == CommonLib::ADMIN_MODULE) {
    session_destroy();
    header("Location:../Admin/");
}if ($from == CommonLib::SALES_MODULE) {
    session_destroy();
    header("Location:../Sales/");
}if ($from == CommonLib::CLIENT_MODULE) {
    session_destroy();
    header("Location:../Client/");
}if ($from == CommonLib::SUPPLIER_MODULE) {
    session_destroy();
    header("Location:../Supplier/");
}if ($from == CommonLib::OPERATION_MODULE) {
    session_destroy();
    header("Location:../Operations/");
}
?>
