<?php
include '../Common/header.php';
$clib->login_reqired(FALSE);
include '../Common/topmenu.php';
include '../Common/leftmenu.php';
?>
<!-- partial -->

<div class="content-wrapper">

    <div class="card" >
        <?php include '../Common/showMessage.php'; ?>
        <div class="card-body" >           
            <?php
            $port = "";
            $host = "";
            $uname = "";
            $pwrd = "";

            $query = "SELECT * from emailconfig";
            $result = $databaseConnection->openConnection()->query($query);
            while ($row = $result->fetch_assoc()) {
                $port = $row['portnum'];
                $host = $row['host'];
                $uname = $row['username'];
                $pwrd = $row['passwrd'];
            }
            ?>

            <div class="modal-dialog mid-size modal-lg modal-dialog-centered " role="document">
                <div class="modal-content">               
                    <div class="container-fluid">
                        <div class="row">                    

                            <div class="col-md-10 py-5 px-sm-5 ">
                                <span class="inner-modal-title" style="text-align:left !important">Notification Email Configuration</span>

                                <form class="cmxform" id="commentForm" method="post" enctype="multipart/form-data" action="../../Service/EmailConfigService.php">
                                    <div class="form-row">

                                        <div class="form-group col-md-12 icon_input_container">
                                            <label for="username">Username</label>
                                            <input id="username" value="<?php echo $uname; ?>" type="text" name="username" class="form-control" required >
                                        </div><div class="form-group col-md-12 icon_input_container">
                                            <label for="passwrd">Password</label>
                                            <input id="passwrd" value="<?php echo $pwrd; ?>" type="password" name="passwrd" class="form-control" required >
                                        </div><div class="form-group col-md-12 icon_input_container">
                                            <label for="host">Host</label>
                                            <input id="host" value="<?php echo $host; ?>" type="text" name="host" class="form-control" required >
                                        </div><div class="form-group col-md-12 icon_input_container">
                                            <label for="portnum">Port</label>
                                            <input id="portnum" value="<?php echo $port; ?>" type="text" name="portnum" class="form-control" required >
                                        </div>                                                                   

                                    </div>
                                    <span style="float:right"><button type="submit" class="modal-x-btn">UPDATE SMTP</button></span>

                                    <input type="hidden" name="serviceFlag" id="serviceFlag" value="ADDEMAILCONFIG"/>
                                    <?php echo $clib->get_csrf_token(); ?>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
</div>


</div>
<!-- content-wrapper ends -->
<?php
include '../Common/footer.php';
include '../Common/jsplugins.php';
?>