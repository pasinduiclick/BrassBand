<?php
include '../Common/header.php';
$clib->login_reqired(TRUE);
include '../Common/topmenu.php';
include '../Common/leftmenu.php';
?>
<!-- partial -->

<div class="content-wrapper">

    <div class="card" >
        <?php include '../Common/showMessage.php'; ?>
        <div class="card-body" >
            <h4 class="card-title">All Contacts</h4>
            <div style="display: initial;" data-placement="right" title="Add a Contact" data-toggle="tooltip"><button data-toggle="modal" data-target="#AddCustomer" type="button"  class="btn btn-inverse-primary btn-fw"><i  class="fa fa-plus"></i></button></div> 

            <!-- Modal Add Customer-->
            <div class="modal fade "   id="AddCustomer"  tabindex="-1" role="dialog"
                 aria-labelledby="AddCustomerModal" aria-hidden="true">
                <div class="modal-dialog mid-size modal-lg modal-dialog-centered " role="document">
                    <div class="modal-content">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-4 d-sm-flex align-items-end round-corners-center" style="background-image: url('../Common/assets/modal-x/img/add-customer.jpg')">
                                    <div style="display:block;height:200px;"></div>
                                </div>

                                <div class="col-md-8 py-5 px-sm-5 ">
                                    <span class="inner-modal-title" style="text-align:left !important">Add Identimark Customer</span>

                                    <form class="cmxform" id="commentForm" method="post" enctype="multipart/form-data" action="../../Services/ContactService.php">
                                        <div class="form-row">
                                            <div class="form-group col-md-12 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/user.png"/>
                                                <select name="acc_id" style="width: 100%;" class="modal-x-dropd">
                                                    <?php
                                                    $query2 = "SELECT * from accounts where status=1";
                                                    $result2 = $databaseConnection->openConnection()->query($query2);
                                                    while ($row2 = $result2->fetch_assoc()) {
                                                        echo ' <option value="' . $row2['acc_id'] . '">' . $row2['business_name'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-12 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/membership.png"/>
                                                <input type="text" name="name" class="form-control" id="icon_input" placeholder="Full Name">
                                            </div>
                                            <div class="form-group col-md-12 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/mail.png"/>
                                                <input type="email" name="email" class="form-control" id="icon_input" placeholder="Email Address">
                                            </div>
                                            <div class="form-group col-md-12 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/phone.png"/>
                                                <input type="tel" name="phone" class="form-control" id="icon_input" placeholder="Phone Number">
                                            </div>
                                        </div>
                                        <button type="submit" class="modal-x-btn">ADD CUSTOMER</button>

                                        <input type="hidden" name="serviceFlag" id="serviceFlag" value="ADDCONT"/>
                                        <?php echo $clib->get_csrf_token(); ?>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Ends -->



            <div class="clearfix" ></div>
            <br/>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="IDM" class="table">
                            <thead>
                                <tr>
                                    <th>Account</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT c.contact_id,a.business_name,c.acc_id,c.name,c.email,c.phone FROM contacts c, accounts a WHERE c.acc_id=a.acc_id AND c.status=1";
                                $result = $databaseConnection->openConnection()->query($query);
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['business_name']; ?></td>
                                        <td><?php echo $row['name']; ?></td> 
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo $row['phone']; ?></td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <div style="display: initial;" data-placement="left" title="View & Edit Contact" data-toggle="tooltip"><button type="button" data-toggle="modal" data-target="#updtaccmodal<?php echo $row['contact_id']; ?>" class="btn btn-sm btn-inverse-primary btn-fw"><i class="fa fa-pencil"></i></button></div>
                                                <button class="btn btn-sm btn-inverse-danger btn-fw" data-placement="right" title="Delete Contact" data-toggle="tooltip"  onclick="return showSwal('warning-message-and-cancel', '../../Services/ContactService.php?serviceFlag=DELCONTAJAX&contact_id=<?php echo $row['contact_id']; ?>&csrf_token=<?php echo $clib->get_csrf_token(true); ?>');"><i class="fa fa-trash"></i></button>  
                                            </div>



                                            <!-- Modal Edit Customer-->
                                            <div class="modal fade "  id="updtaccmodal<?php echo $row['contact_id']; ?>"  tabindex="-1" role="dialog"
                                                 aria-labelledby="AddCustomerModal" aria-hidden="true">
                                                <div class="modal-dialog mid-size modal-lg modal-dialog-centered " role="document">
                                                    <div class="modal-content">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <div class="container-fluid">
                                                            <div class="row">
                                                                <div class="col-md-4 d-sm-flex align-items-end round-corners-center" style="background-image: url('../Common/assets/modal-x/img/add-customer.jpg')">
                                                                    <div style="display:block;height:200px;"></div>
                                                                </div>

                                                                <div class="col-md-8 py-5 px-sm-5 ">
                                                                    <span class="inner-modal-title" style="text-align:left !important">Edit Identimark Customer Contact</span>

                                                                    <form class="cmxform" id="commentForm" method="post" enctype="multipart/form-data" action="../../Services/ContactService.php">
                                                                        <div class="form-row">
                                                                            <div class="form-group col-md-12 icon_input_container">
                                                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/user.png"/>
                                                                                <select name="acc_id" style="width: 100%;" class="modal-x-dropd">
                                                                                    <?php
                                                                                    $query2 = "SELECT * from accounts where status=1";
                                                                                    $result2 = $databaseConnection->openConnection()->query($query2);
                                                                                    while ($row2 = $result2->fetch_assoc()) {
                                                                                        echo ' <option value="' . $row2['acc_id'] . '">' . $row2['business_name'] . '</option>';
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                            </div>
                                                                            
                                                                            <div class="form-group col-md-12 icon_input_container">
                                                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/membership.png"/>
                                                                                <input type="text" name="name" class="form-control" value="<?php echo $row["name"]; ?>" id="icon_input" placeholder="Full Name">
                                                                            </div>
                                                                            <div class="form-group col-md-12 icon_input_container">
                                                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/mail.png"/>
                                                                                <input type="email" name="email" class="form-control" value="<?php echo $row["email"]; ?>" id="icon_input" placeholder="Email Address">
                                                                            </div>
                                                                            <div class="form-group col-md-12 icon_input_container">
                                                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/phone.png"/>
                                                                                <input type="tel" name="phone" class="form-control" value="<?php echo $row["phone"]; ?>" id="icon_input" placeholder="Phone Number">
                                                                            </div>
                                                                        </div>
                                                                        <button type="submit" class="modal-x-btn">Edit Contact</button>

                                                                        <input type="hidden" name="contact_id" value="<?php echo $row['contact_id']; ?>"/>
                                                                        <input type="hidden" name="serviceFlag" id="serviceFlag" value="UPDATECONT"/>
                                                                        <?php echo $clib->get_csrf_token(); ?>
                                                                    </form>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal Ends -->





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