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
            <h4 class="card-title">All Products Category</h4>
            <div style="display: initial;" data-placement="right" title="Add a Term" data-toggle="tooltip"><button data-toggle="modal" data-target="#AddCutter" type="button"  class="btn btn-inverse-primary btn-fw"><i  class="fa fa-plus"></i></button></div> 

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
                                    <span class="inner-modal-title" style="text-align:left !important">Add New Products Category</span>

                                    <form class="cmxform" id="commentForm" method="post" enctype="multipart/form-data" action="../../Services/ProdutsService.php">
                                        <div class="form-row">

                                            <div class="form-group col-md-12 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/cost.png"/>
                                                <input type="text" name="prefix" class="form-control" id="term_name" placeholder="Prefix" required>
                                            </div>
                                            <div class="form-group col-md-12 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/cost.png"/>
                                                <input type="text" name="cat_desc" class="form-control" id="term_name" placeholder="Category Description" required>
                                            </div>
                                            <div class="form-group col-md-12 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/cost.png"/>
                                                <input type="text" name="proceedure" class="form-control" id="term_name" placeholder="Proceedure" required>
                                            </div>
                                            <div class="form-group col-md-12 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/cost.png"/>
                                                <input type="text" name="pcsqm" class="form-control" id="term_name" placeholder="Print Cost Sqm" required>
                                            </div>
                                            <div class="form-group col-md-12 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/cost.png"/>
                                                <input type="text" name="acsqm" class="form-control" id="term_name" placeholder="Alloy Cost Sqm" required>
                                            </div>
                                            <div class="form-group col-md-12 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/cost.png"/>
                                                <input type="text" name="plcsqm" class="form-control" id="term_name" placeholder="Plastic Cost Sqm" required>
                                            </div>
                                            <div class="form-group col-md-12 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/cost.png"/>
                                                <input type="text" name="tcsqm" class="form-control" id="term_name" placeholder="Tape Cost Sqm" required>
                                            </div>
                                            <div class="form-group col-md-12 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/cost.png"/>
                                                <input type="text" name="natgum" class="form-control" id="term_name" placeholder="Natgum cost" required>
                                            </div>
                                        </div>
                                        <button type="submit" class="modal-x-btn" name="serviceFlag" id="serviceFlag" value="ADDPRODCATEGORY">ADD CATEGORY</button>

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
                        <table id="IDM" class="table datatable">
                            <thead>
                                <tr>
                                    <th>Prefix</th>
                                    <th>Description</th>
                                    <th>Proceedure</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * from product_categories where status=1";
                                
                                $result = $databaseConnection->openConnection()->query($query);
                                while ($row = $result->fetch_assoc()) {
                                    echo '<tr>
                                                        <td>' . $row['prefix'] . '</td>
                                                        <td>' . mb_strimwidth($row['cat_desc'], 0, 50, "...") . '</td>';
                                                       echo ' <td>' . $row['proceedure'] . '</td>
                                                        <td>
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <div style="display: initial;" data-placement="left" title="View & Edit Product" data-toggle="tooltip"><button type="button" data-toggle="modal" data-target="#updtaccmodal' . $row['prod_cat'] . '" class="btn btn-sm btn-inverse-primary btn-fw"><i class="fa fa-pencil"></i></button></div>
                                                            <button class="btn btn-sm btn-inverse-danger btn-fw" data-placement="right" title="Delete Product Category" data-toggle="tooltip"  onclick="return showSwal(' . "'warning-message-and-cancel','../../Services/ProdutsService.php?serviceFlag=DELPRODCATEGORY&prod_cat=" . $row['prod_cat'] . "&csrf_token=" . $clib->get_csrf_token(true) . "&acc_id=1'" . ')"><i class="fa fa-trash"></i></button>  
                                                        </div>
                                                           
                                                                                                                      
                                                        
                                                                <!-- Edit Product Modal -->
    <div class="modal fade  " id="updtaccmodal' . $row['prod_cat'] . '"  tabindex="-1" role="dialog"
         aria-labelledby="AddProduct" aria-hidden="true">
 <div class="modal-dialog mid-size modal-lg modal-dialog-centered min-top" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
               <div class="container-fluid">
                   <div class="row">
                       <div class="col-md-2 d-sm-flex align-items-end round-corners" style="background-image: url(../Common/assets/modal-x/img/products-banner.jpg)">
                          <div style="display:block;height:100px;"></div>
                       </div>
                       <div class="col-md-10 py-5 px-sm-5 ">
                           <span class="inner-modal-title" style="text-align:left !important">Add New Product</span>
                                                   <form class="cmxform" id="commentForm" method="post" enctype="multipart/form-data" action="../../Services/ProdutsService.php">
                                        <div class="form-row">

                                            <div class="form-group col-md-12 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/cost.png"/>
                                                <input type="text" name="prefix" class="form-control" id="term_name" placeholder="Prefix" value="' . $row['prefix'] . '" required>
                                            </div>
                                            <div class="form-group col-md-12 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/cost.png"/>
                                                <input type="text" name="cat_desc" class="form-control" id="term_name" placeholder="Category Description" value="' . $row['cat_desc'] . '" required>
                                            </div>
                                            <div class="form-group col-md-12 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/cost.png"/>
                                                <input type="text" name="proceedure" class="form-control" id="term_name" placeholder="Proceedure" value="' . $row['proceedure'] . '" >
                                            </div>
                                            <div class="form-group col-md-12 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/cost.png"/>
                                                <input type="text" name="pcsqm" class="form-control" id="term_name" placeholder="Print Cost Sqm" value="' . $row['pcsqm'] . '">
                                            </div>
                                            <div class="form-group col-md-12 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/cost.png"/>
                                                <input type="text" name="acsqm" class="form-control" id="term_name" placeholder="Alloy Cost Sqm" value="' . $row['acsqm'] . '">
                                            </div>
                                            <div class="form-group col-md-12 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/cost.png"/>
                                                <input type="text" name="plcsqm" class="form-control" id="term_name" placeholder="Plastic Cost Sqm" value="' . $row['plcsqm'] . '">
                                            </div>
                                            <div class="form-group col-md-12 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/cost.png"/>
                                                <input type="text" name="tcsqm" class="form-control" id="term_name" placeholder="Tape Cost Sqm" value="' . $row['tcsqm'] . '">
                                            </div>
                                            <div class="form-group col-md-12 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/cost.png"/>
                                                <input type="text" name="natgum" class="form-control" id="term_name" placeholder="Natgum cost" value="' . $row['natgum'] . '">
                                            </div>
                                        </div>
                                        <input type="hidden" name="prod_cat" value="' . $row['prod_cat'] . '"/>
                                        <button type="submit" class="modal-x-btn" name="serviceFlag" id="serviceFlag" value="UPDATEPRODCATEGORY">UPDATE CATEGORY</button>

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