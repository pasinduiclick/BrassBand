<?php include '../Common/header.php';?>
<body class="sidebar-dark">
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0 login-page-bg">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <?php include '../Common/showMessage.php'; ?>
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <div style="text-align: center;" class="brand-logo">
                                <img style="width: inherit;" src="../Common/assets/images/logo-black.png" alt="logo">
                            </div>
                            <h4 class="text-center" >Order Management | Adminpanel</h4>
                            <h6 class="font-weight-light text-center">Sign in to continue.</h6>
                            <form method="post" action="../../Services/userService.php" class="pt-3 cmxform" id="commentForm">
                                <div class="form-group">
                                    <input name="username" type="text" class="form-control form-control-lg" id="exampleInputEmail1" required placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <input name="psword" type="password" class="form-control form-control-lg" id="exampleInputPassword1" required placeholder="Password">
                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                                </div>
                              
                                <input type="hidden" name="serviceFlag" id="serviceFlag" value="ADMLOGIN"/>
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
