<?php
$titlename = "Add Email Template";
include '../Common/header.php';
$clib->login_reqired(TRUE);
include '../Common/topmenu.php';
include '../Common/leftmenu.php';
?>
    <!-- partial -->

    <div class="content-wrapper">

        <div class="card">
            <?php include '../Common/showMessage.php'; ?>
            <div class="card-body">
                <h4 class="card-title">All Email Templates</h4>
                <div style="display: initial;" data-placement="right" title="Add a Sign Size" data-toggle="tooltip"><button data-toggle="modal" data-target="#EmailTemplate" type="button" class="btn btn-inverse-primary btn-fw"><i  class="fa fa-plus"></i></button></div>




                <!-- Modal Email Template -->
                <div class="modal fade " id="EmailTemplate" tabindex="-1" role="dialog" aria-labelledby="EmailTemplateModel" aria-hidden="true">
                    <div class="modal-dialog mid-size modal-lg modal-dialog-centered " role="document">
                        <div class="modal-content">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-4 d-sm-flex align-items-end round-corners-center" style="background-image: url('../Common/assets/modal-x/img/keyboard.jpg')">
                                        <div style="display:block;height:200px;"></div>
                                    </div>

                                    <div class="col-md-8 py-5 px-sm-5 ">
                                        <span class="inner-modal-title" style="text-align:left !important">Add New Email Template</span>

                                        <form class="cmxform" id="commentForm" method="post" enctype="multipart/form-data" action="../../Services/NotificationService.php">
                                            <div class="form-row">

                                                <div class="form-group col-md-12 icon_input_container">
                                                    <img class="icon_input_img" src="../Common/assets/modal-x/img/mail.png" />
                                                    <select name="template" id="template" class="modal-x-dropd" required>
                                                    <option disabled="" selected="">Select a Template</option>
                                                    <option value="1~Order Added" >Order Added</option>
                                                    <option value="2~Artwork Confirmation" >Artwork Confirmation</option>
                                                    <option value="3~Quote Added" >Quote Added</option>
                                                    <option value="4~Transfered to Supplier" >Transfered to Supplier</option>
                                                    <option value="5~Order Completed" >Order Completed</option>
                                                    <option value="6~Client Added" >Client Added</option>
                                                    <option value="7~Sales User Added" >Sales User Added</option>
                                                </select>
                                                </div>

                                                <div class="form-group col-md-12 icon_input_container">
                                                    
                                                    <textarea class="form-control summernote"  name="message" required></textarea>
                                                </div>

                                            </div>
                                            <button type="submit" class="modal-x-btn">SAVE CHANGES</button>

                                            <input type="hidden" name="serviceFlag" id="serviceFlag" value="ADDEMAILTEMPLATE" />
                                            <?php echo $clib->get_csrf_token(); ?>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- old model
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">

                        <form class="cmxform" id="commentForm" method="post" enctype="multipart/form-data" action="../../Services/NotificationService.php">
                            <div class="modal-body modal-mod">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <li class="fa fa-times-circle" ></li>
                                </button>

                                <fieldset>
                                    <div class="row" >
                                        <div class="col-md-6 col-sm-6 modal-mod-pic">
                                            <div class="separate" ></div>
                                        </div>
                                        <div class="col-md-6 col-sm-6" >
                                            <br/>
                                            <div class="form-group">
                                                <label for="template">Template</label>
                                                <select name="template" id="template" class="form-control select2" required>
                                                    <option disabled="" selected="">Select a Template</option>
                                                    <option value="1~Order Added" >Order Added</option>
                                                    <option value="2~Quote Added" >Quote Added</option>
                                                    <option value="3~Transfered to Supplier" >Transfered to Supplier</option>
                                                    <option value="4~Order Completed" >Order Completed</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="notes">Email Message</label>
                                                <textarea class="form-control summernote" style="height: 96px;" name="message" required></textarea>
                                            </div>

                                            <div class="row" >
                                                <div class="col-md-6 modal-mod-footer" >
                                                    <li class="fa fa-info-circle" ></li><p> By Clicking "<?php echo $titlename; ?>" you confirm that the Sign Size is legitimate</p>

                                                </div>
                                                <div class="col-md-6" >
                                                    <button type="submit" class="btn btn-inverse-dark btn-fw float-right"><?php echo $titlename; ?></button>
                                                </div>
                                            </div>

                                            <br/>
                                        </div>

                                    </div>

                                    <input type="hidden" name="serviceFlag" id="serviceFlag" value="ADDEMAILTEMPLATE"/>
                                    <?php echo $clib->get_csrf_token(); ?>
                                </fieldset>

                            </div>

                        </form>
                    </div>
                </div>
            </div>-->



                <div class="clearfix"></div>
                <br/>
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table id="IDM" class="table">
                                <thead>
                                    <tr>
                                        <th>Template Name</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                $query = "SELECT * from email_templates where status=1";
                                $result = $databaseConnection->openConnection()->query($query);
                                while ($row = $result->fetch_assoc()) {
                                    echo '<tr>
                                                        <td>' . $row['tempName'] . '</td>
                                                        
                                                        <td>
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <div style="display: initial;" data-placement="left" title="View & Edit sign" data-toggle="tooltip"><button type="button" data-toggle="modal" data-target="#updtaccmodal' . $row['id'] . '" class="btn btn-sm btn-inverse-primary btn-fw"><i class="fa fa-pencil"></i></button></div>
                                                            <button class="btn btn-sm btn-inverse-danger btn-fw" data-placement="right" title="Delete sign" data-toggle="tooltip"  onclick="return showSwal(' . "'warning-message-and-cancel','../../Services/NotificationService.php?serviceFlag=DELETEEMAILTEMPLATE&id=" . $row['id'] . "&csrf_token=" . $clib->get_csrf_token(true) . "'" . ')"><i class="fa fa-trash"></i></button>  
                                                        </div>
               <!-- Modal Email Template -->
    <div class="modal fade "   id="updtaccmodal' . $row['id'] . '"  tabindex="-1" role="dialog"
         aria-labelledby="EmailTemplateModel" aria-hidden="true">
        <div class="modal-dialog mid-size modal-lg modal-dialog-centered " role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
               <div class="container-fluid">
                   <div class="row">
                       <div class="col-md-4 d-sm-flex align-items-end round-corners-center" style="background-image: url(../Common/assets/modal-x/img/keyboard.jpg)">
                          <div style="display:block;height:200px;"></div>
                       </div>
                      
                       <div class="col-md-8 py-5 px-sm-5 ">
                           <span class="inner-modal-title" style="text-align:left !important">Add New Email Template</span>
                             
                             <form class="cmxform" id="commentForm" method="post" enctype="multipart/form-data" action="../../Services/NotificationService.php">
                               <div class="form-row">
                                
                                   <div class="form-group col-md-12 icon_input_container">
                                       <img class="icon_input_img" src="../Common/assets/modal-x/img/mail.png"/>
                                      <select name="template" id="template" class="modal-x-dropd" required>
                                                    <option value="' . $row['templateId'] . '~' . $row['tempName'] . '" selected="">' . $row['tempName'] . '</option>
                                                    <option disabled="" >Select a Template</option>
                                                    <option value="1~Order Added" >Order Added</option>
                                                    <option value="2~Quote Added" >Quote Added</option>
                                                    <option value="3~Transfered to Supplier" >Transfered to Supplier</option>
                                                    <option value="4~Order Completed" >Order Completed</option>
                                                </select>
                                   </div>
                                   
                                    <div class="form-group col-md-12 icon_input_container">
                                       
                                     <textarea class="form-control summernote fixed" name="message" required>' . stripslashes($row['message']) . '</textarea>
                                   </div>
                                   
                               </div>
                              <button type="submit" class="modal-x-btn">UPDATE CHANGES</button>
                              
                           <input type="hidden" name="id" value="' . $row['id'] . '"/>
<input type="hidden" name="serviceFlag" id="serviceFlag" value="UPDATEEMAILTEMPLATE"/>
' . $clib->get_csrf_token() . '
                           </form>
                          
                       </div>
                   </div>
               </div>
            </div>
        </div>
    </div>
   
                                                                                                                      
                                                        <!-- oldform
                                                                <div class="modal fade" id="updtaccmodal' . $row['id'] . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-center" style="width: 100%;">Edit a Sign</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        
                        
                       <form class="cmxform" id="commentForm" method="post" enctype="multipart/form-data" action="../../Services/NotificationService.php">
                            <div class="modal-body">

                                <fieldset>
                                    <div class="container-fluid">
                                        <div class="row">
                                            
                                            <div class="col-md-12 col-lg-12">
                                                <div class="form-group">
                                                <label for="template">Template</label>
                                                <select name="template" id="template" class="form-control select2" required>
                                                    <option value="' . $row['templateId'] . '~' . $row['tempName'] . '" selected="">' . $row['tempName'] . '</option>
                                                    <option value="1~Order Added" >Order Added</option>
                                                    <option value="2~Artwork Confirmation" >Artwork Confirmation</option>
                                                    <option value="3~Quote Added" >Quote Added</option>
                                                    <option value="4~Transfered to Supplier" >Transfered to Supplier</option>
                                                    <option value="5~Order Completed" >Order Completed</option>
                                                    <option value="6~Client Added" >Client Added</option>
                                                    <option value="7~Sales User Added" >Sales User Added</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="notes">Email Message</label>
                                                <textarea class="form-control summernote" s name="message" required>' . $row['message'] . '</textarea>
                                            </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <input type="hidden" name="id" value="' . $row['id'] . '"/>
<input type="hidden" name="serviceFlag" id="serviceFlag" value="UPDATEEMAILTEMPLATE"/>
' . $clib->get_csrf_token() . '
                                </fieldset>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" value="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>  old form -->
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
