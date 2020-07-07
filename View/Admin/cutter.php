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
            <h4 class="card-title">All Cutters</h4>
            <div style="display: initial;" data-placement="right" title="Add a Cutter" data-toggle="tooltip"><button data-toggle="modal" data-target="#AddCutter" type="button"  class="btn btn-inverse-primary btn-fw"><i  class="fa fa-plus"></i></button></div> 

  <!-- Modal Add Customer-->
    <div class="modal fade "   id="AddCutter"  tabindex="-1" role="dialog"
         aria-labelledby="AddCutterModel" aria-hidden="true">
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
                           <span class="inner-modal-title" style="text-align:left !important">Add New Cutter Type</span>
                             
                             <form class="cmxform" id="commentForm" method="post" enctype="multipart/form-data" action="../../Services/CuttingService.php">
                               <div class="form-row">
                                
                                   <div class="form-group col-md-12 icon_input_container">
                                       <img class="icon_input_img" src="../Common/assets/modal-x/img/cost.png"/>
                                       <input type="number" name="cost_price" class="form-control" id="icon_input" placeholder="Cost Price" required>
                                   </div>
                                   
                                    <div class="form-group col-md-12 icon_input_container">
                                       <img class="icon_input_img" src="../Common/assets/modal-x/img/fee.png"/>
                                       <input type="number" name="total_cutting_cost" class="form-control" id="icon_input" placeholder="Total Cutting Cost" required>
                                   </div>
                                   
                                    <div class="form-group col-md-12 icon_input_container">
                                       <img class="icon_input_img" src="../Common/assets/modal-x/img/area.png"/>
                                       <input type="number" name="total_cutting_area" class="form-control" id="icon_input" placeholder="Total Cutting Area" required>
                                   </div>
                                   
                                   <div class="form-group col-md-12 icon_input_container">
                                       <img class="icon_input_img" src="../Common/assets/modal-x/img/dollar.png"/>
                                       <input type="number" name="cost_per_unit" class="form-control" id="icon_input" placeholder="Cost Per Unit" required>
                                   </div>
                                   
                                   <div class="form-group col-md-12 icon_input_container">
                                       <img class="icon_input_img" src="../Common/assets/modal-x/img/input.png"/>
                                       <input type="text" name="cutter_name" class="form-control" id="icon_input" placeholder="Cutter Name" required>
                                   </div>
                                   
                               </div>
                              <button type="submit" class="modal-x-btn">ADD CUTTER</button>
                              
                               <input type="hidden" name="serviceFlag" id="serviceFlag" value="ADDCUTTER"/>
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
                                    <th>Cutter</th>
                                    <th>Cost Price</th>
                                    <th>Total Cutting Area</th>
                                    <th>Total Cutting Cost</th>
                                    <th>Cost per Unit</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * from cutting where status=1";
                                $result = $databaseConnection->openConnection()->query($query);
                                while ($row = $result->fetch_assoc()) {
                                    echo '<tr>
                                                        <td>' . $row['cutter_name'] . '</td>
                                                        <td>' . $row['cost_price'] . '</td>
                                                            <td>' . $row['total_cutting_area'] . '</td>
                                                                <td>' . $row['total_cutting_cost'] . '</td>
                                                                    <td>' . $row['cost_per_unit'] . '</td>
                                                        <td>
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <div style="display: initial;" data-placement="left" title="View & Edit Cutter" data-toggle="tooltip"><button type="button" data-toggle="modal" data-target="#updtaccmodal' . $row['cutting_id'] . '" class="btn btn-sm btn-inverse-primary btn-fw"><i class="fa fa-pencil"></i></button></div>
                                                            <button class="btn btn-sm btn-inverse-danger btn-fw" data-placement="right" title="Delete Cutter" data-toggle="tooltip"  onclick="return showSwal(' . "'warning-message-and-cancel','../../Services/CuttingService.php?serviceFlag=DELCUTTER&cut_id=" . $row['cutting_id'] . "&csrf_token=" . $clib->get_csrf_token(true) . "'" . ')"><i class="fa fa-trash"></i></button>  
                                                        </div>
                                                           
                      <!-- Modal Add Customer-->
    <div class="modal fade "  id="updtaccmodal' . $row['cutting_id'] . '" tabindex="-1" role="dialog"
         aria-labelledby="AddCutterModel" aria-hidden="true">
        <div class="modal-dialog mid-size modal-lg modal-dialog-centered " role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
               <div class="container-fluid">
                   <div class="row">
                       <div class="col-md-4 d-sm-flex align-items-end round-corners-center" style="background-image: url(../Common/assets/modal-x/img/cutter.jpg)">v
                          <div style="display:block;height:200px;"></div>
                       </div>
                      
                       <div class="col-md-8 py-5 px-sm-5 ">
                           <span class="inner-modal-title" style="text-align:left !important">Add New Cutter Type</span>
                             
                             <form class="cmxform" id="commentForm" method="post" enctype="multipart/form-data" action="../../Services/CuttingService.php">
                               <div class="form-row">
                                
                                   <div class="form-group col-md-12 icon_input_container">
                                       <img class="icon_input_img" src="../Common/assets/modal-x/img/cost.png"/>
                                       <input type="number" name="cost_price" value="' . $row['cost_price'] . '" class="form-control" id="icon_input" placeholder="Cost Price" required>
                                   </div>
                                   
                                    <div class="form-group col-md-12 icon_input_container">
                                       <img class="icon_input_img" src="../Common/assets/modal-x/img/fee.png"/>
                                       <input type="number" name="total_cutting_cost" value="' . $row['total_cutting_cost'] . '" class="form-control" id="icon_input" placeholder="Total Cutting Cost" required>
                                   </div>
                                   
                                    <div class="form-group col-md-12 icon_input_container">
                                       <img class="icon_input_img" src="../Common/assets/modal-x/img/area.png"/>
                                       <input type="number" name="total_cutting_area" value="' . $row['total_cutting_area'] . '" class="form-control" id="icon_input"  placeholder="Total Cutting Area" required>
                                   </div>
                                   
                                   <div class="form-group col-md-12 icon_input_container">
                                       <img class="icon_input_img" src="../Common/assets/modal-x/img/dollar.png"/>
                                       <input type="number" name="cost_per_unit" value="' . $row['cost_per_unit'] . '" class="form-control" id="icon_input" placeholder="Cost Per Unit" required>
                                   </div>
                                   
                                   <div class="form-group col-md-12 icon_input_container">
                                       <img class="icon_input_img" src="../Common/assets/modal-x/img/input.png"/>
                                       <input type="text" name="cutter_name" value="' . $row['cutter_name'] . '" class="form-control" id="icon_input" placeholder="Cutter Name" required>
                                   </div>
                                   
                               </div>
                              <button type="submit" class="modal-x-btn">EDIT CUTTER</button>
                              
                                 <input type="hidden" name="cut_id" value="' . $row['cutting_id'] . '"/>
<input type="hidden" name="serviceFlag" id="serviceFlag" value="UPDTCUTTER"/>
' . $clib->get_csrf_token() . '
                           </form>
                          
                       </div>
                   </div>
               </div>
            </div>
        </div>
    </div>
    <!-- Modal Ends -->                                                                                                 
                                                        
                                                         <!--       <div class="modal fade" id="updtaccmodal' . $row['cutting_id'] . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-center" style="width: 100%;">Edit Cutter</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="cmxform" id="commentForm" method="post" enctype="multipart/form-data" action="../../Services/CuttingService.php">
                            <div class="modal-body">

                                <fieldset>
                                    <div class="container-fluid">
                                        <div class="row">
                                        <div class="col-md-12 col-lg-12">
                                            <div class="form-group">
                                                <label for="cost_price">Cost Price</label>
                                                <input id="cost_price" value="' . $row['cost_price'] . '" type="number" name="cost_price" class="form-control" required >
                                            </div>
                                            <div class="form-group">
                                                <label for="total_cutting_area">Total Cutting_area</label>
                                                <input id="total_cutting_area" value="' . $row['total_cutting_area'] . '" type="number" name="total_cutting_area" class="form-control" required >
                                            </div>
                                            <div class="form-group">
                                                <label for="total_cutting_cost">Total Cutting_cost</label>
                                                <input id="total_cutting_area" value="' . $row['total_cutting_cost'] . '" type="number" name="total_cutting_cost" class="form-control" required >
                                            </div>
                                            <div class="form-group">
                                                <label for="cost_per_unit">Cost Per Unit</label>
                                                <input id="cost_per_unit" value="' . $row['cost_per_unit'] . '" type="number" name="cost_per_unit" class="form-control" required >
                                            </div>
                                            <div class="form-group">
                                                <label for="cutter_name">Cutter Name</label>
                                                <input id="cutter_name" value="' . $row['cutter_name'] . '" type="text" name="cutter_name" class="form-control" required >
                                            </div>
                                            
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <input type="hidden" name="cut_id" value="' . $row['cutting_id'] . '"/>
<input type="hidden" name="serviceFlag" id="serviceFlag" value="UPDTCUTTER"/>
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