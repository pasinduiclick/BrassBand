<?php include '../Common/header.php';?>
<body class="sidebar-dark">
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <?php include '../Common/showMessage.php'; ?>
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <div style="text-align: center;" class="brand-logo">
                                <img src="../Common/assets/images/logo.png" width="100" alt="logo">
                            </div>
                            <h4 class="text-center" >Members Management Panel</h4>
                            <h6 class="font-weight-light text-center">Sign in to continue.</h6>
                            <form method="POST" action="../../Service/UserService.php" class="pt-3 cmxform" id="commentForm">
                                <div class="form-group">
                                    <input name="username" type="text" class="form-control form-control-lg" id="exampleInputEmail1" required placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <input name="passwrd" type="password" class="form-control form-control-lg" id="exampleInputPassword1" required placeholder="Password">
                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                                </div>                                
                                <input type="hidden" name="serviceFlag" id="serviceFlag" value="USERLOGIN"/>
                                <?php echo $clib->get_csrf_token(); ?>
                            </form>

                        </div>

                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <?php include '../Common/jsplugins.php'; ?>
