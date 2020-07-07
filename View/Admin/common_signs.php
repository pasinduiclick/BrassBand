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
            <h4 class="card-title">All Common Signs</h4>
            <div style="display: initial;" data-placement="right" title="Add a Common Sign" data-toggle="tooltip"><button data-toggle="modal" data-target="#AddSign" type="button"  class="btn btn-inverse-primary btn-fw"><i  class="fa fa-plus"></i></button></div> 
            
            <!-- Modal Common Sign-->
    <div class="modal fade "   id="AddSign"  tabindex="-1" role="dialog"
         aria-labelledby="AddSign" aria-hidden="true">
        <div class="modal-dialog mid-size modal-lg modal-dialog-centered " role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
               <div class="container-fluid">
                   <div class="row">
                       <div class="col-md-4 d-sm-flex align-items-end round-corners-center" style="background-image: url('../Common/assets/modal-x/img/commonsign.jpg')">
                          <div style="display:block;height:200px;"></div>
                       </div>
                      
                       <div class="col-md-8 py-5 px-sm-5 ">
                           <span class="inner-modal-title" style="text-align:left !important">Add New Common Sign</span>
                             
                             <form class="cmxform" id="commentForm" method="post" enctype="multipart/form-data" action="../../Services/CommonSignsService.php">
                               <div class="form-row">
                                
                                   <div class="form-group col-md-12 icon_input_container">
                                       <img class="icon_input_img" src="../Common/assets/modal-x/img/cost.png"/>
                                       <input type="text" name="title" class="form-control" id="icon_input" placeholder="Title" required>
                                   </div>
                                   
                                    <div class="form-group col-md-12 icon_input_container">
                                       <img class="icon_input_img" src="../Common/assets/modal-x/img/input.png"/>
                                       <input name="description" class="form-control" id="icon_input" placeholder="Description" required>
                                   </div>
                                   
                                   <div class="form-group col-md-12 icon_input_container">
                                       <img class="icon_input_img" src="../Common/assets/modal-x/img/upload.png"/>
                                       <input type="file" name="fileToUpload" class="form-control" id="icon_input" placeholder="Photo">
                                       
                                   </div>
      
                               </div>
                                 <span style="float:right"><button type="submit" class="modal-x-btn">ADD COMMON SIGN</button></span>
                              
                                <input type="hidden" name="serviceFlag" id="serviceFlag" value="ADDSIGN"/>
                                    <?php echo $clib->get_csrf_token(); ?>
                           
                           </form>
                          
                       </div>
                   </div>
               </div>
            </div>
        </div>
    </div>
    <!-- Modal Ends -->

        <!--    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">

                        <form class="cmxform" id="commentForm" method="post" enctype="multipart/form-data" action="../../Services/CommonSignsService.php">
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
                                                <label for="Phone">Title</label>
                                                <input id="Phone" type="text" name="title" class="form-control" required >
                                            </div>
                                            <div class="form-group">
                                                <label for="notes">Notes</label>
                                                <textarea name="description" id="notes" class="form-control" ></textarea>
                                            </div>

                                            <div class="form-group">
                                                <label for="notes">Photo</label>
                                                <input type="file" name="fileToUpload" class="form-control">
                                            </div>
                                            <br/>
                                            <div class="row" >
                                                <div class="col-md-6 modal-mod-footer" >
                                                    <li class="fa fa-info-circle" ></li><p> By Clicking "Add Common Sign" you confirm that the Common Sign is legitimate</p>

                                                </div>
                                                <div class="col-md-6" >
                                                    <button type="submit" class="btn btn-inverse-dark btn-fw float-right">Add Common Sign</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="serviceFlag" id="serviceFlag" value="ADDSIGN"/>
                                    <?php // echo $clib->get_csrf_token(); ?>
                                </fieldset>

                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>-->



            <div class="clearfix" ></div>
            <br/>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="IDM" class="table">
                            <thead>
                                <tr>
                                    <th>Photo</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * from commonsigns where status=1";
                                $result = $databaseConnection->openConnection()->query($query);
                                while ($row = $result->fetch_assoc()) {
                                    echo '<tr>
                                                        <td><img style="width:150px !important; border-radius:0;" src="../../Services/' . $row['cs_pic'] . '" /></td>
                                                        <td>' . $row['cs_title'] . '</td>
                                                        <td>' . $row['cs_description'] . '</td>                                                       
                                                        <td>
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <div style="display: initial;" data-placement="left" title="View & Edit sign" data-toggle="tooltip"><button type="button" data-toggle="modal" data-target="#updtaccmodal' . $row['cs_id'] . '" class="btn btn-sm btn-inverse-primary btn-fw"><i class="fa fa-pencil"></i></button></div>
                                                            <button class="btn btn-sm btn-inverse-danger btn-fw" data-placement="right" title="Delete sign" data-toggle="tooltip"  onclick="return showSwal(' . "'warning-message-and-cancel','../../Services/CommonSignsService.php?serviceFlag=DELSIGN&c_id=" . $row['cs_id'] . "&csrf_token=" . $clib->get_csrf_token(true) . "'" . ')"><i class="fa fa-trash"></i></button>  
                                                        </div>
                                                           
  <!-- Edit Modal Common Sign-->
    <div class="modal fade "  id="updtaccmodal' . $row['cs_id'] . '" tabindex="-1" role="dialog"
         aria-labelledby="AddSign" aria-hidden="true">
        <div class="modal-dialog mid-size modal-lg modal-dialog-centered " role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
               <div class="container-fluid">
                   <div class="row">
                       <div class="col-md-4 d-sm-flex align-items-end round-corners-center" style="background-image: url(../Common/assets/modal-x/img/commonsign.jpg)">
                          <div style="display:block;height:200px;"></div>
                       </div>
                      
                       <div class="col-md-8 py-5 px-sm-5 ">
                           <span class="inner-modal-title" style="text-align:left !important">Add New Common Sign</span>
                             
                             <form class="cmxform" id="commentForm" method="post" enctype="multipart/form-data" action="../../Services/CommonSignsService.php">
                               <div class="form-row">
                                
                                   <div class="form-group col-md-12 icon_input_container">
                                       <img class="icon_input_img" src="../Common/assets/modal-x/img/cost.png"/>
                                       <input type="text" name="title" value="' . $row['cs_title'] . '" class="form-control" id="icon_input" placeholder="Title" required>
                                   </div>
                                   
                                    <div class="form-group col-md-12 icon_input_container">
                                       <img class="icon_input_img" src="../Common/assets/modal-x/img/input.png"/>
                                       <input name="description" value="' . $row['cs_description'] . '" class="form-control" id="icon_input" placeholder="Description" required>
                                   </div>
                                   
                                   <div class="form-group col-md-12 icon_input_container">
                                       <img class="icon_input_img" src="../Common/assets/modal-x/img/upload.png"/>
                                       <input type="file" name="fileToUpload" class="form-control" id="icon_input" placeholder="Photo">
                                   </div>
                                   
                                   <div class="form-group col-md-12 icon_input_container">
                                        <img style="width:150px !important;    border-radius:0;" src="../../Services/' . $row['cs_pic'] . '" />
                                   </div>
                        
                               </div>
                               <span style="float:right"> <button type="submit" class="modal-x-btn">EDIT COMMON SIGN</button></span>
                              
                                <input type="hidden" name="cid" value="' . $row['cs_id'] . '"/>
<input type="hidden" name="serviceFlag" id="serviceFlag" value="UPDTSIGN"/>
' . $clib->get_csrf_token() . '
                           
                           </form>
                          
                       </div>
                   </div>
               </div>
            </div>
        </div>
    </div>
    <!-- Modal Ends -->                                                                                                                      
                                                        
                                                                <!-- <div class="modal fade" id="updtaccmodal' . $row['cs_id'] . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-center" style="width: 100%;">Edit a Sign</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="cmxform" id="commentForm" method="post" enctype="multipart/form-data" action="../../Services/CommonSignsService.php">
                            <div class="modal-body">

                                <fieldset>
                                    <div class="container-fluid">
                                        <div class="row">
                                            
                                            <div class="col-md-12 col-lg-12">
                                                <div class="form-group">
                                                    <label for="Phone">Title</label>
                                                    <input id="Phone" type="text" name="title" value="' . $row['cs_title'] . '" class="form-control" required >
                                                </div>
                                                <div class="form-group">
                                                    <label for="notes">Notes</label>
                                                    <textarea id="notes" name="description" class="form-control" >' . $row['cs_description'] . '</textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label for="notes">Photo</label>
                                                    <img style="width:200px;    border-radius:0;" src="../../Services/' . $row['cs_pic'] . '" />
                                                    <br/><br/>
                                                    <div class="clearfix" ></div>
                                                    <input type="file" name="fileToUpload" class="form-control">
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <input type="hidden" name="cid" value="' . $row['cs_id'] . '"/>
<input type="hidden" name="serviceFlag" id="serviceFlag" value="UPDTSIGN"/>
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
            </div> -->






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