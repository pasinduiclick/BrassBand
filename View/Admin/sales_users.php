<?php
include '../Common/header.php';
$clib->login_reqired(TRUE);
include '../Common/topmenu.php';
include '../Common/leftmenu.php';
?>
<!-- partial -->

<div class="content-wrapper">
    <h5>Settings</h5>
    <?php include '../Common/showMessage.php'; ?>
    <div class="clearfix" ></div>
    <br/>
    <div class="card" >
        <div class="card-body" >
            <h4 class="card-title">Sales Users</h4>
            <div style="display: initial;" data-placement="right" title="Add Sales User" data-toggle="tooltip"><button data-toggle="modal" data-target="#exampleModal" type="button"  class="btn btn-inverse-primary btn-fw"><i  class="fa fa-plus"></i></button></div> 

            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-center" style="width: 100%;">Add Sales User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="cmxform" id="commentForm" method="post" action="../../Services/SalesLogin.php">
                            <div class="modal-body">

                                <fieldset>

                                    <div class="row">
                                        <div class="col-md-12 col-lg-12">
                                            <div class="form-group">
                                                <label for="firstname">Full Name</label>
                                                <input id="firstname" required="" placeholder="Sales user's full name" class="form-control" name="full_name" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input id="email" class="form-control" placeholder="Email address" name="email" type="email">
                                            </div>                                            
                                        </div>
                                    </div>

                                    <input type="hidden" name="serviceFlag" value="SALESREG" />
                                    <?php echo $clib->get_csrf_token(); ?>

                                </fieldset>
                                <div class="badge badge-primary"><li class="fa fa-info-circle" ></li> An Auto Generated Email confirmation will be sent to the Sales User</div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" value="submit" class="btn btn-primary">Add User</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="clearfix" ></div>
            <br/>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query2 = "SELECT * from sales_users where status!=0";
                                $result2 = $databaseConnection->openConnection()->query($query2);
                                while ($row2 = $result2->fetch_assoc()) {
                                    ?>
                                        <td>
                                            <?php echo $row2["full_name"]; ?>
                                        </td>
                                        <td><?php echo $row2["email"]; ?></td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <button class="btn btn-sm btn-inverse-secondary btn-fw" data-placement="right" title="Send a New Password" data-toggle="tooltip"  onclick="return showSwal('warning-message-and-cancel', '../../Services/SalesLogin.php?serviceFlag=RESETSALESUSER&email=<?php echo $row2['email']; ?>&csrf_token=<?php echo $clib->get_csrf_token(true); ?>')"><i class="fa fa-shield"></i></button>
                                                <button class="btn btn-sm btn-inverse-danger btn-fw" data-placement="right" title="Delete Administrator" data-toggle="tooltip"  onclick="return showSwal('warning-message-and-cancel', '../../Services/SalesLogin.php?serviceFlag=DELETESALESUSER&sales_id=<?php echo $row2['sales_id']; ?>&csrf_token=<?php echo $clib->get_csrf_token(true); ?>&switch=3')"><i class="fa fa-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php }
                                ?>                                                    
                            </tbody>
                        </table>

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