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
            <h4 class="card-title">All System Users</h4>
            <div style="display: initial;" data-placement="right" title="Add a Member" data-toggle="tooltip"><button data-toggle="modal" data-target="#AddCutter" type="button"  class="btn btn-inverse-primary btn-fw"><i  class="fa fa-plus"></i></button></div> 

            <!-- Modal Add Customer-->
            <div class="modal fade "   id="AddCutter"  tabindex="-1" role="dialog"
                 aria-labelledby="AddMemberModel" aria-hidden="true">
                <div class="modal-dialog mid-size modal-lg modal-dialog-centered " role="document">
                    <div class="modal-content">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-4 d-sm-flex align-items-end round-corners-center" style="background-image: url('../Common/assets/modal-x/img/users.png')">
                                    <div style="display:block;height:200px;"></div>
                                </div>

                                <div class="col-md-8 py-5 px-sm-5 ">
                                    <span class="inner-modal-title" style="text-align:left !important">Add New Music</span>

                                    <form class="cmxform" id="commentForm" method="post" enctype="multipart/form-data" action="../../Service/UserService.php">
                                        <div class="form-row">
                                            <div class="form-group col-md-12 icon_input_container">
                                                <label for="username">Username</label>
                                                <input id="username" type="text" name="username" class="form-control" required >
                                            </div><div class="form-group col-md-12 icon_input_container">
                                                <label for="passwrd">Password</label>
                                                <input id="passwrd" type="text" name="passwrd" class="form-control" required >
                                            </div><div class="form-group col-md-12 icon_input_container">
                                                <label for="full_name">Full Name</label>
                                                <input id="full_name" type="text" name="full_name" class="form-control" required >
                                            </div><div class="form-group col-md-12 icon_input_container">
                                                <label for="email">Email</label>
                                                <input id="email" type="text" name="email" class="form-control" required >
                                            </div>
                                        </div>
                                        <button type="submit" class="modal-x-btn" name="serviceFlag" id="serviceFlag" value="ADDNEWUSER">ADD USER</button>

                                        <?php echo $clib->get_csrf_token(); ?>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="clearfix" ></div>
            <br/>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="IDM" class="table">
                            <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Username</th>                                                                      
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * from users where status=1";
                                $result = $databaseConnection->openConnection()->query($query);
                                while ($row = $result->fetch_assoc()) {
                                    echo '<tr>
                                                        <td>' . $row['full_name'] . '</td>
                                                       <td>' . $row['email'] . '</td>'
                                    . '<td>' . $row['username'] . '</td>'
                                    . '<td><div class="btn-group" role="group" aria-label="Basic example">                                                           
                                                            <button class="btn btn-sm btn-inverse-danger btn-fw" data-placement="right" title="Delete User" data-toggle="tooltip"  onclick="return showSwal(' . "'warning-message-and-cancel','../../Service/UserService.php?serviceFlag=DELUSER&user_id=" . $row['user_id'] . "&csrf_token=" . $clib->get_csrf_token(true) . "'" . ')"><i class="fa fa-trash"></i></button>  
                                                        </div>
                       </div>
                   </div>
               </div>
            </div>
        </div>
    </div>
    <!-- Modal Ends -->                                                                                                                                                                                                                  
</td></tr>';
                                }
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