<?php
include '../Common/header.php';
$clib->login_reqired(TRUE);
include '../Common/topmenu.php';
include '../Common/leftmenu.php';
?>
<!-- partial -->

<div class="content-wrapper">
    <h5>Settings</h5>
    <div class="card" >
        <?php include '../Common/showMessage.php'; ?>
        <div class="card-body" >
            <h4 class="card-title">Profile Settings</h4>

            <div class="clearfix" ></div>
            <br/>

            <form class="cmxform" id="signupForm" method="POST" action="../../Services/userService.php">
                <fieldset>
                    <?php
                    $query = "SELECT * from admin_users where admin_id=" . $_SESSION['admin_id'];
                    $result = $databaseConnection->openConnection()->query($query);
                    if ($row = $result->fetch_assoc()) {
                        ?>
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="firstname">Full Name</label>
                                    <input id="firstname" value="<?php echo $row["full_name"]; ?>" required="" placeholder="Your name in full" class="form-control" name="fullname" type="text">
                                </div>
                                <div class="form-group">
                                    <label for="password">New Password</label>
                                    <input id="password" class="form-control" placeholder="Password" name="confirm_password" type="password">
                                </div>

                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input id="username" value="<?php echo $row["user_name"]; ?>" placeholder="User name" class="form-control" name="username" type="text">
                                </div>
                                <div class="form-group">
                                    <label for="confirm_password">Confirm New Password</label>
                                    <input id="confirm_password" class="form-control" placeholder="Confirm password" name="password" type="password">
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12" >
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" class="form-control" placeholder="Email address" value="<?php echo $row["email"]; ?>" name="email" type="email">
                                </div>
                            </div>

                        </div>
                    <?php } ?>
                    <input type="hidden" name="serviceFlag" value="UPDATEADMIN" />
                    <?php echo $clib->get_csrf_token(); ?>
                    <input class="btn btn-primary" type="submit" value="Submit">
                </fieldset>
            </form>

        </div>
    </div>
    <div class="clearfix" ></div>
    <br/>
    <div class="card" >
        <div class="card-body" >
            <h4 class="card-title">System Administrators</h4>
            <div style="display: initial;" data-placement="right" title="Add an Administrator" data-toggle="tooltip"><button data-toggle="modal" data-target="#exampleModal" type="button"  class="btn btn-inverse-primary btn-fw"><i  class="fa fa-plus"></i></button></div> 

            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-center" style="width: 100%;">Add an Administrator</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="cmxform" id="commentForm" method="post" action="../../Services/userService.php">
                            <div class="modal-body">

                                <fieldset>

                                    <div class="row">
                                        <div class="col-md-12 col-lg-12">
                                            <div class="form-group">
                                                <label for="firstname">Full Name</label>
                                                <input id="firstname" required="" placeholder="Your name in full" class="form-control" name="fullname" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input id="email" class="form-control" placeholder="Email address" name="email" type="email">
                                            </div>
                                            <div class="form-group">
                                                <label for="username">Username</label>
                                                <input id="username"  placeholder="User name" class="form-control" name="username" type="text">
                                            </div>

                                            <div class="form-group">
                                                <label for="adr">Administration Role</label>
                                                <select name="adminr" id="adr" class="form-control" >
                                                    <option value="1" >Super Administrator</option>
                                                    <option value="2" >Normal Administrator</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="serviceFlag" value="ADMINREG" />
                                    <?php echo $clib->get_csrf_token(); ?>

                                </fieldset>
                                <div class="badge badge-primary"><li class="fa fa-info-circle" ></li> An Auto Generated Email confirmation will be sent to the Administrator's Email Address.</div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" value="submit" class="btn btn-primary">Save changes</button>
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
                                    <th>Role & Full Name</th>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query2 = "SELECT * from admin_users where status!=3 AND admin_id!=".$_SESSION["admin_id"];
                                $result2 = $databaseConnection->openConnection()->query($query2);
                                while ($row2 = $result2->fetch_assoc()) {
                                    ?>
                                <tr <?php if($row2["status"]==="2"){ echo 'class="table-danger" data-placement="top" title="Administrator is Locked" data-toggle="tooltip"'; } ?>>
                                        <td>
                                            <?php
                                            if ($row2["admin_role"] == 1) {
                                                echo '<div class="badge badge-outline-primary">Super Admin</div>';
                                            } else {
                                                echo '<div class="badge badge-outline-warning">Normal Admin</div>';
                                            }
                                            ?>
                                            <?php echo $row2["full_name"]; ?>

                                        </td>
                                        <td><?php echo $row2["user_name"]; ?></td>
                                        <td><?php echo $row2["email"]; ?></td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <?php
                                                if($row2["status"]==="2"){ ?>
                                                    <button type="button" data-placement="left" title="Unlock Administrator" data-toggle="tooltip" class="btn btn-inverse-dark btn-fw" onclick="return showSwal('warning-message-and-cancel', '../../Services/userService.php?serviceFlag=ADMINSWITCH&admin_id=<?php echo $row2['admin_id']; ?>&csrf_token=<?php echo $clib->get_csrf_token(true); ?>&switch=1')" ><li class="fa fa-unlock" ></li></button>
                                               <?php }else{ ?>
                                                    <button type="button" data-placement="left" title="Lock Administrator" data-toggle="tooltip" class="btn btn-inverse-dark btn-fw" onclick="return showSwal('warning-message-and-cancel', '../../Services/userService.php?serviceFlag=ADMINSWITCH&admin_id=<?php echo $row2['admin_id']; ?>&csrf_token=<?php echo $clib->get_csrf_token(true); ?>&switch=2')" ><li class="fa fa-lock" ></li></button>
                                              <?php  } ?>
                                                
                                                <div style="display: initial;" data-placement="left" title="View & Edit Administrator" data-toggle="tooltip"><button type="button" data-toggle="modal" data-target="#updtadmin<?php echo $row2['admin_id']; ?>" class="btn btn-sm btn-inverse-primary btn-fw"><i class="fa fa-pencil"></i></button></div>
                                                <button class="btn btn-sm btn-inverse-secondary btn-fw" data-placement="right" title="Send a New Password" data-toggle="tooltip"  onclick="return showSwal('warning-message-and-cancel', '../../Services/userService.php?serviceFlag=ADMINSWITCH&admin_id=<?php echo $row2['admin_id']; ?>&csrf_token=<?php echo $clib->get_csrf_token(true); ?>&switch=4&fullname=<?php echo $row2['full_name']; ?>&username=<?php echo $row2['user_name']; ?>&email=<?php echo $row2['email']; ?>')"><i class="fa fa-shield"></i></button>
                                                <button class="btn btn-sm btn-inverse-danger btn-fw" data-placement="right" title="Delete Administrator" data-toggle="tooltip"  onclick="return showSwal('warning-message-and-cancel', '../../Services/userService.php?serviceFlag=ADMINSWITCH&admin_id=<?php echo $row2['admin_id']; ?>&csrf_token=<?php echo $clib->get_csrf_token(true); ?>&switch=3')"><i class="fa fa-trash"></i></button>
                                                
                                            </div>


                                            <div class="modal fade" id="updtadmin<?php echo $row2['admin_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-center" style="width: 100%;">Update Administrator</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form class="cmxform" id="commentForm" method="post" action="../../Services/userService.php">
                                                            <div class="modal-body">

                                                                <fieldset>

                                                                    <div class="row">
                                                                        <div class="col-md-12 col-lg-12">
                                                                            <div class="form-group">
                                                                                <label for="firstname">Full Name</label>
                                                                                <input id="firstname" required="" value="<?php echo $row2["full_name"]; ?>" placeholder="Your name in full" class="form-control" name="fullname" type="text">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="email">Email</label>
                                                                                <input id="email" class="form-control" value="<?php echo $row2["email"]; ?>" placeholder="Email address" name="email" type="email">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="username">Username</label>
                                                                                <input id="username"  placeholder="User name" value="<?php echo $row2["user_name"]; ?>" class="form-control" name="username" type="text">
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label for="adr">Administration Role: <?php if($row2["admin_role"]==="1"){ echo 'Super Administrator'; }else{ echo 'Normal Administrator'; } ?></label>
                                                                                <select name="adminr" id="adr" class="form-control" >
                                                                                    <option value="1" >Super Administrator</option>
                                                                                    <option value="2" >Normal Administrator</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <input type="hidden" name="admin_id" value="<?php echo $row2['admin_id']; ?>"/>
                                                                    <input type="hidden" name="serviceFlag" value="UPDATEADMIN" />
                                                                    <?php echo $clib->get_csrf_token(); ?>

                                                                </fieldset>
                                                                
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" value="submit" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
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