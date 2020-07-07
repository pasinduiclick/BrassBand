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
            <h4 class="card-title">All Members</h4>
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
                                <div class="col-md-4 d-sm-flex align-items-end round-corners-center" style="background-image: url('../Common/assets/modal-x/img/cutter.jpg')">
                                    <div style="display:block;height:200px;"></div>
                                </div>

                                <div class="col-md-8 py-5 px-sm-5 ">
                                    <span class="inner-modal-title" style="text-align:left !important">Add New Member</span>

                                    <form class="cmxform" id="commentForm" method="post" enctype="multipart/form-data" action="../../Service/MemberService.php">
                                        <div class="form-row">
                                            <div class="form-group col-md-12 icon_input_container">
                                                <label for="name">Name</label>
                                                <input id="name" type="text" name="name" class="form-control" required >
                                            </div><div class="form-group col-md-12 icon_input_container">
                                                <label for="email">Email</label>
                                                <input id="email" type="email" name="email" class="form-control" required >
                                            </div><div class="form-group col-md-12 icon_input_container">
                                                <label for="address">Address</label>
                                                <input id="address" type="text" name="address" class="form-control" required >
                                            </div><div class="form-group col-md-12 icon_input_container">
                                                <label for="phone">Phone</label>
                                                <input id="phone" type="text" name="phone" class="form-control" required >
                                            </div><div class="form-group col-md-12 icon_input_container">
                                                <label for="parents_name">Parents name</label>
                                                <input id="parents_name" type="text" name="parents_name" class="form-control"  >
                                            </div><div class="form-group col-md-12 icon_input_container">
                                                <label for="parents_email">Parents email</label>
                                                <input id="parents_email" type="email" name="parents_email" class="form-control"  >
                                            </div><div class="form-group col-md-12 icon_input_container">
                                                <label for="parents_phone">Parents phone</label>
                                                <input id="parents_phone" type="text" name="parents_phone" class="form-control"  >
                                            </div><div class="form-group col-md-12 icon_input_container">
                                                <label for="parents_mobile">Parents mobile</label>
                                                <input id="parents_mobile" type="text" name="parents_mobile" class="form-control"  >
                                            </div><div class="form-group col-md-12 icon_input_container">
                                                <label for="membership_type">Membership type</label>
                                                <select name="membership_type"  class="form-control" required>
                                                    <option value="">--Please Select--</option>
                                                    <option value="Life">Life</option>
                                                    <option value="Ordinary">Ordinary</option>
                                                    <option value="Honorary">Honorary</option>
                                                </select>

                                            </div>
                                            <div class="form-group col-md-12 icon_input_container">
                                                <label for="membership_category">Membership Category</label>
                                                <select name="membership_category"  class="form-control" required>
                                                    <option value="">--Please Select--</option>
                                                    <option value="Playing">Playing</option>
                                                    <option value="Non Playing">Non Playing</option>
                                                    <option value="Committee">Committee</option>
                                                    <option value="First Class Brass">First Class Brass</option>
                                                </select>

                                            </div><div class="form-group col-md-12 icon_input_container">
                                                <label for="date_joined">Date joined</label>
                                                <input id="date_joined" type="date" name="date_joined" class="form-control" required >
                                            </div><div class="form-group col-md-12 icon_input_container">
                                                <label for="date_left">Date left</label>
                                                <input id="date_left" type="date" name="date_left" class="form-control"  >
                                            </div>
                                        </div>
                                        <button type="submit" class="modal-x-btn" name="serviceFlag" id="serviceFlag" value="ADDNEWMEM">ADD MEMBER</button>

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
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Type</th>
                                    <th>Category</th>
                                    <th>Joined</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * from membership where status=1";
                                $result = $databaseConnection->openConnection()->query($query);
                                while ($row = $result->fetch_assoc()) {
                                    echo '<tr>
                                                        <td>' . $row['name'] . '</td>
                                                       <td>' . $row['email'] . '</td>'
                                            . '<td>' . $row['phone'] . '</td>'
                                            . '<td>' . $row['membership_type'] . '</td>'
                                            . '<td>' . $row['membership_category'] . '</td>'
                                            . ' <td>' . $row['date_joined'] . '</td></tr>';
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