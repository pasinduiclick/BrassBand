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
            <h4 class="card-title">All Accounts</h4>
            <div style="display: initial;" data-placement="right" title="Add Account" data-toggle="tooltip"><button data-toggle="modal" data-target="#AddAccount" type="button"  class="btn btn-inverse-primary btn-fw"><i  class="fa fa-plus"></i></button></div> 

            <!-- Add Account Modal -->
            <div class="modal fade  " id="AddAccount"  tabindex="-1" role="dialog"
                 aria-labelledby="AddAccount" aria-hidden="true">
                <div class="modal-dialog mid-size modal-lg modal-dialog-centered min-top" role="document">
                    <div class="modal-content">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-2 d-sm-flex align-items-end round-corners-center" style="background-image: url('../Common/assets/modal-x/img/account.jpg')">
                                    <div style="display:block;height:100px;"></div>
                                </div>
                                <div class="col-md-10 py-5 px-sm-5 ">
                                    <span class="inner-modal-title" style="text-align:left !important">Add New Account</span>
                                    <form class="cmxform" id="commentForm" method="post" enctype="multipart/form-data" action="../../Services/AccountsService.php">
                                        <div class="form-row">
                                            <div class="form-group col-md-6 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/work.png"/>
                                                <input type="text" class="form-control" id="icon_input" name="business" placeholder="Business">
                                            </div>
                                            <div class="form-group col-md-6 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/address.png"/>
                                                <input type="text" class="form-control" id="icon_input" name="postAddress" placeholder="Postal (Billing) address">
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/address.png"/>
                                                <input type="text" class="form-control" id="icon_input" name="phyAddress" placeholder="Physical/ Delivery address">
                                            </div>
                                            <div class="form-group col-md-6 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/flag.png"/>

                                                <select name="country" class="modal-x-dropd">
                                                    <option value="New Zealand">New Zealand</option>
                                                    <option value="Australia">Australia</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/flag.png"/>
                                                <select name="xeroapi" class="modal-x-dropd">
                                                    <option value="NZ">NZ</option>
                                                    <option value="AU">AU</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/user.png"/>
                                                <select name="acc_term" class="modal-x-dropd">
                                                    <option disabled="" selected="">Select Account Term</option>
                                                    <?php
                                                    $query = "SELECT * from acc_terms where status=1";
                                                    $result = $databaseConnection->openConnection()->query($query);
                                                    while ($row = $result->fetch_assoc()) {
                                                        echo '<option value="' . $row['acc_term_id'] . '" >' . $row['term_name'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/user.png"/>
                                                <input type="text" class="form-control" id="icon_input" name="contact" placeholder="Contact person">
                                            </div>
                                            <div class="form-group col-md-6 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/phone.png"/>
                                                <input type="text" class="form-control" id="icon_input" name="phone" placeholder="Phone">
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/mail.png"/>
                                                <input type="text" class="form-control" id="icon_input" name="email" placeholder="Email" required="">
                                            </div>
                                            <div class="form-group col-md-6 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/fee.png"/>
                                                <input type="text" class="form-control" id="icon_input" name="setupfee" placeholder="Set up fee">
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/support.png"/>
                                                <input type="text" class="form-control" id="icon_input" name="frphand" placeholder="FR/P/Hand">
                                            </div>
                                            <div class="form-group col-md-6 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/upload.png"/>
                                                <input type="file" name="fileToUpload" class="form-control" id="icon_input" placeholder="Logo Upload">

                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/address.png"/>
                                                <input type="text" class="form-control" id="icon_input" name="street" placeholder="Street name">
                                            </div>
                                            <div class="form-group col-md-6 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/address.png"/>
                                                <input type="text" class="form-control" id="icon_input" name="postal_code" placeholder="Postal Code">
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/address.png"/>
                                                <input type="text" class="form-control" id="icon_input" name="suberb" placeholder="Suberb">
                                            </div>
                                            <div class="form-group col-md-6 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/address.png"/>
                                                <input type="text" class="form-control" id="icon_input" name="state" placeholder="State">
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/support.png"/>
                                                Insurance Approved <input type="checkbox" class="form-control" id="icon_input" name="insurance_approved" placeholder="Insurance Approved" value="1">
                                            </div>
                                            <div class="form-group col-md-6 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/dollar.png"/>
                                                <input type="text" class="form-control" id="icon_input" name="insurance_value" placeholder="Insurance Value">
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-12 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/note.png"/>
                                                <input type="text" class="form-control" id="icon_input" name="notes" placeholder="Notes">
                                            </div>
                                        </div>

                                        <span style="float:right"> <button type="submit" class="modal-x-btn" >ADD ACCOUNT</button></span>

                                        <input type="hidden" name="serviceFlag" id="serviceFlag" value="ADDACC"/>
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
                                    <th>Business</th>
                                    <th>Contact person</th>
                                    <th>Phone</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * from accounts where status=1";
                                $result = $databaseConnection->openConnection()->query($query);
                                while ($row = $result->fetch_assoc()) {
                                    echo '<tr>
                                                        <td>' . $row['business_name'] . '</td>
                                                        <td>' . $row['contact'] . '</td>
                                                        <td>' . $row['phone'] . '</td>                                                       
                                                        <td>
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <div style="display: initial;" data-placement="left" title="Edit Account" data-toggle="tooltip"><button type="button" data-toggle="modal" data-target="#updtaccmodal' . $row['acc_id'] . '" class="btn btn-sm btn-inverse-primary btn-fw"><i class="fa fa-pencil"></i></button></div>
                                                            <button class="btn btn-sm btn-inverse-danger btn-fw" data-placement="right" title="Delete Account" data-toggle="tooltip"  onclick="return showSwal(' . "'warning-message-and-cancel','../../Services/AccountsService.php?serviceFlag=DELACCAJAX&acc_id=" . $row['acc_id'] . "&csrf_token=" . $clib->get_csrf_token(true) . "'" . ')"><i class="fa fa-trash"></i></button>  
                                                        </div>
                                                           
                                                                                                                      
                                                        
                                                                
 <!-- Add Account Modal -->
    <div class="modal fade  "  id="updtaccmodal' . $row['acc_id'] . '"  tabindex="-1" role="dialog"
         aria-labelledby="AddAccount" aria-hidden="true">
 <div class="modal-dialog mid-size modal-lg modal-dialog-centered min-top" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
               <div class="container-fluid">
                   <div class="row">
                       <div class="col-md-2 d-sm-flex align-items-end round-corners-center" style="background-image: url(../Common/assets/modal-x/img/account.jpg)">
                          <div style="display:block;height:100px;"></div>
                       </div>
                       <div class="col-md-10 py-5 px-sm-5 ">
                           <span class="inner-modal-title" style="text-align:left !important">Edit Account</span>
                        <form class="cmxform" id="commentForm" method="post" enctype="multipart/form-data" action="../../Services/AccountsService.php">
                               <div class="form-row">
                                   <div class="form-group col-md-6 icon_input_container">
                                       <img class="icon_input_img" src="../Common/assets/modal-x/img/work.png"/>
                                       <input type="text" class="form-control" id="icon_input" value="' . $row['business_name'] . '"  name="business" placeholder="Business">
                                   </div>
                                   <div class="form-group col-md-6 icon_input_container">
                                       <img class="icon_input_img" src="../Common/assets/modal-x/img/address.png"/>
                                       <input type="text" class="form-control" id="icon_input" value="' . $row['post_address'] . '" name="postAddress" placeholder="Postal (Billing) address">
                                   </div>
                               </div>
                               
                               <div class="form-row">
                                   <div class="form-group col-md-6 icon_input_container">
                                       <img class="icon_input_img" src="../Common/assets/modal-x/img/address.png"/>
                                       <input type="text" class="form-control" id="icon_input" name="phyAddress" value="' . $row['phy_address'] . '" placeholder="Physical/ Delivery address">
                                   </div>
                                   <div class="form-group col-md-6 icon_input_container">
                                       <img class="icon_input_img" src="../Common/assets/modal-x/img/flag.png"/>
                                     
                                       <select name="country" class="modal-x-dropd" value="' . $row['country'] . '">
                                                        <option value="New Zealand">New Zealand</option>
                                                        <option value="Australia">Australia</option>
                                                    </select>
                                   </div>
                               </div>
                               
                                <div class="form-row">
                                            <div class="form-group col-md-6 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/flag.png"/>
                                               <select name="xeroapi" class="modal-x-dropd" value="' . $row['xeroapi'] . '">
                                                    <option value="NZ">NZ</option>
                                                    <option value="AU">AU</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/user.png"/>
                                                <select name="acc_term" class="modal-x-dropd">
                                                    <option disabled="" selected="">Select Account Term</option>';
                                                   
                                                    $queryx = "SELECT * from acc_terms where status=1";
                                                    $resultx = $databaseConnection->openConnection()->query($queryx);
                                                    while ($rowx = $resultx->fetch_assoc()) {
                                                        echo '<option value="' . $rowx['acc_term_id'] . '" >' . $rowx['term_name'] . '</option>';
                                                    }
                                                    
                                                    echo '</select>
                                            </div>
                                        </div>
                                        
                                  <div class="form-row">
                                   <div class="form-group col-md-6 icon_input_container">
                                       <img class="icon_input_img" src="../Common/assets/modal-x/img/user.png"/>
                                       <input type="text" class="form-control" id="icon_input"  value="' . $row['contact'] . '" name="contact" placeholder="Contact person">
                                   </div>
                                   <div class="form-group col-md-6 icon_input_container">
                                       <img class="icon_input_img" src="../Common/assets/modal-x/img/phone.png"/>
                                       <input type="text" class="form-control" id="icon_input" value="' . $row['phone'] . '" name="phone" placeholder="Phone">
                                   </div>
                               </div>
                               
                               
                                <div class="form-row">
                                   <div class="form-group col-md-6 icon_input_container">
                                       <img class="icon_input_img" src="../Common/assets/modal-x/img/mobile.png"/>
                                       <input type="text" class="form-control" id="icon_input" value="' . $row['mobile'] . '" name="mobile" placeholder="Mobile">
                                   </div>
                                   <div class="form-group col-md-6 icon_input_container">
                                       <img class="icon_input_img" src="../Common/assets/modal-x/img/fee.png"/>
                                       <input type="text" class="form-control" id="icon_input" value="' . $row['setup_fee'] . '"  name="setupfee" placeholder="Set up fee">
                                   </div>
                               </div>
                               
                                <div class="form-row">
                                   <div class="form-group col-md-6 icon_input_container">
                                       <img class="icon_input_img" src="../Common/assets/modal-x/img/support.png"/>
                                       <input type="text" class="form-control" id="icon_input" value="' . $row['frphand'] . '"  name="frphand" placeholder="FR/P/Hand">
                                   </div>
                                   <div class="form-group col-md-6 icon_input_container">
                                       <img class="icon_input_img" src="../Common/assets/modal-x/img/upload.png"/>
                                       <input type="file" name="fileToUpload" class="form-control" id="icon_input" placeholder="Logo Upload">
                                   </div>
                               </div>
                               
                               <div class="form-row">
                                            <div class="form-group col-md-6 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/address.png"/>
                                                <input type="text" class="form-control" id="icon_input" name="street" placeholder="Street name" value="' . $row['street'] . '" />
                                            </div>
                                            <div class="form-group col-md-6 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/address.png"/>
                                                <input type="text" class="form-control" id="icon_input" name="postal_code" placeholder="Postal Code" value="' . $row['postal_code'] . '" />
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/address.png"/>
                                                <input type="text" class="form-control" id="icon_input" name="suberb" placeholder="Suberb" value="' . $row['suberb'] . '" />
                                            </div>
                                            <div class="form-group col-md-6 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/address.png"/>
                                                <input type="text" class="form-control" id="icon_input" name="state" placeholder="State" value="' . $row['state'] . '" />
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/support.png"/>
                                                Insurance Approved <input type="checkbox" class="form-control" id="icon_input" name="insurance_approved" placeholder="Insurance Approved">
                                            </div>
                                            <div class="form-group col-md-6 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/dollar.png"/>
                                                <input type="text" class="form-control" id="icon_input" name="insurance_value" placeholder="Insurance Value" value="' . $row['insurance_value'] . '" />
                                            </div>
                                        </div>
                               
                                <div class="form-row">
                                   <div class="form-group col-md-6 icon_input_container">
                                   </div>
                                   <div class="form-group col-md-6 icon_input_container">
                                      <img class="uploaded-img" style="width:200px !important;    border-radius:0;" src="../../Services/' . $row['logo'] . '" />
                                   </div>
                                    
                               </div>
                               
                               <div class="form-row">
                                   <div class="form-group col-md-12 icon_input_container">
                                       <img class="icon_input_img" src="../Common/assets/modal-x/img/note.png"/>
                                       <input type="text" class="form-control" id="icon_input" value="' . $row['notes'] . '" name="notes" placeholder="Notes">
                                   </div>
                               </div>
                               
                              <span style="float:right"> <button type="submit" class="modal-x-btn" >UPDATE ACCOUNT</button></span>
                               
                           <input type="hidden" name="acc_id" id="acc_id" value="' . $row['acc_id'] . '"/>
                           <input type="hidden" name="serviceFlag" id="serviceFlag" value="UPDATEACC"/>
                           ' . $clib->get_csrf_token() . '
                               
                           </form>
                       </div>
                   </div>
               </div>
            </div>
        </div>
    </div>
    <!-- Modal Ends -->





</td>
                                                    </tr>';
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