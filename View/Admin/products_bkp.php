<?php
include '../Common/header.php';
$clib->login_reqired(TRUE);
$acc_id = $clib->input("acc_id");
include '../Common/topmenu.php';
include '../Common/leftmenu.php';
?>
<!-- partial -->

<div class="content-wrapper">

    <div class="card" >
        <?php include '../Common/showMessage.php'; ?>
        <div class="card-body" >
            <h4 class="card-title">Products</h4>
            <div style="display: initial;" data-placement="right" title="Add a Product" data-toggle="tooltip"><button data-toggle="modal" data-target="#AddProduct" type="button"  class="btn btn-inverse-primary btn-fw"><i  class="fa fa-plus"></i></button></div> 

            <!-- Add Product Modal -->
            <div class="modal fade  " id="AddProduct"  tabindex="-1" role="dialog"
                 aria-labelledby="AddProduct" aria-hidden="true">
                <div class="modal-dialog mid-size modal-lg modal-dialog-centered min-top" role="document">
                    <div class="modal-content">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-2 d-sm-flex align-items-end round-corners" style="background-image: url('../Common/assets/modal-x/img/products-banner.jpg')">
                                    <div style="display:block;height:100px;"></div>
                                </div>
                                <div class="col-md-10 py-5 px-sm-5 ">
                                    <span class="inner-modal-title" style="text-align:left !important">Add New Product</span>
                                    <form class="cmxform" id="commentForm" method="post" enctype="multipart/form-data" action="../../Services/ProdutsService.php">
                                        <div class="form-row">
                                            <div class="form-group col-md-12 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/address.png"/>
                                                <input type="text" class="form-control" id="icon_input" name="category" placeholder="Category">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/address.png"/>
                                                <input type="text" class="form-control" id="icon_input" name="code" placeholder="Code">
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-12 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/address.png"/>
                                                <input  type="text" class="form-control" id="icon_input" name="description" placeholder="Description">
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-12 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/user.png"/>
                                                <input  type="text" class="form-control" id="icon_input" name="notes" placeholder="Product Notes">
                                            </div>

                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-12 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/note.png"/>
                                                <input type="number" class="form-control" id="icon_input" name="qty" placeholder="Qty">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/dollar.png"/>
                                                <input type="number" class="form-control" id="icon_input" name="price" placeholder="Price">
                                            </div>

                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-12 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/upload.png"/>
                                                <input type="file" name="fileToUpload" class="form-control" id="icon_input" placeholder="Product Image">

                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/note.png"/>
                                                <input type="number" class="form-control" id="icon_input" name="min_order_qty" placeholder="Minimum Order Qty">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/note.png"/>
                                                <input type="number" class="form-control" id="icon_input" name="min_qty_alert" placeholder="Minimum Qty Alert">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12 icon_input_container">
                                                Publish : <input type="checkbox" class="form-control" id="icon_input" name="publish" value="1" />
                                            </div>
                                        </div>
                                        <input type="hidden" name="serviceFlag" id="serviceFlag" value="ADDPROD"/>
                                        <input type="hidden" name="acc_id" id="acc_id" value="<?php echo $acc_id; ?>"/>
                                        <?php echo $clib->get_csrf_token(); ?>

                                        <button type="submit" class="modal-x-btn" >ADD PRODUCT</button>
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
                        <table id="IDM" class="table datatable">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Description</th>
                                    <th>Qty</th>
                                    <th>Account</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT *,(select business_name from accounts where acc_id=products.acc_id) AS business_name from products where acc_id='$acc_id' AND status=1";
                                if ($acc_id == 0) {
                                    $query = "SELECT *,(select business_name from accounts where acc_id=products.acc_id) AS business_name from products where status=1";
                                }
                                $result = $databaseConnection->openConnection()->query($query);
                                while ($row = $result->fetch_assoc()) {
                                    echo '<tr>
                                                        <td>' . $row['prod_code'] . '</td>
                                                        <td>' . mb_strimwidth($row['prod_desc'], 0, 50, "...") . '</td>';
                                    if ($row['min_qty_alert'] >= $row['prod_qty']) {
                                     echo '<td style="color:red">' . $row['prod_qty'] . '</td>';    
                                    } else {
                                     echo '<td style="color:green">' . $row['prod_qty'] . '</td>';    
                                    };
                                   
                                                       echo ' <td>' . $row['business_name'] . '</td>
                                                        <td>
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <div style="display: initial;" data-placement="left" title="View & Edit Product" data-toggle="tooltip"><button type="button" data-toggle="modal" data-target="#updtaccmodal' . $row['prod_id'] . '" class="btn btn-sm btn-inverse-primary btn-fw"><i class="fa fa-pencil"></i></button></div>
                                                            <button class="btn btn-sm btn-inverse-danger btn-fw" data-placement="right" title="Delete Product" data-toggle="tooltip"  onclick="return showSwal(' . "'warning-message-and-cancel','../../Services/ProdutsService.php?serviceFlag=DELPRODAJAX&prod_id=" . $row['prod_id'] . "&csrf_token=" . $clib->get_csrf_token(true) . "&acc_id=" . $acc_id . "'" . ')"><i class="fa fa-trash"></i></button>  
                                                        </div>
                                                           
                                                                                                                      
                                                        
                                                                <!-- Edit Product Modal -->
    <div class="modal fade  " id="updtaccmodal' . $row['prod_id'] . '"  tabindex="-1" role="dialog"
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
                                       <img class="icon_input_img" src="../Common/assets/modal-x/img/address.png"/>
                                       <input type="text" class="form-control" id="icon_input" value="' . $row['prod_code'] . '" name="code" placeholder="Code">
                                   </div>
                               </div>
                               
                               <div class="form-row">
                                   <div class="form-group col-md-12 icon_input_container">
                                       <img class="icon_input_img" src="../Common/assets/modal-x/img/address.png"/>
                                       <input  type="text" class="form-control" id="icon_input" value="' . $row['prod_desc'] . '" name="description" placeholder="Description">
                                   </div>
                               </div>
                               
                                  <div class="form-row">
                                   <div class="form-group col-md-12 icon_input_container">
                                       <img class="icon_input_img" src="../Common/assets/modal-x/img/user.png"/>
                                       <input  type="text" class="form-control" id="icon_input" value="' . $row['prod_notes'] . '" name="notes" placeholder="Product Notes">
                                   </div>                                   
                               </div>
                                <div class="form-row">
                                            <div class="form-group col-md-12 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/note.png"/>
                                                <input type="number" class="form-control" id="icon_input" name="qty" placeholder="Qty" value="' . $row['prod_qty'] . '">
                                            </div>
                                        </div>
                                <div class="form-row">
                                   <div class="form-group col-md-12 icon_input_container">
                                       <img class="icon_input_img" src="../Common/assets/modal-x/img/mobile.png"/>
                                       <input type="number" class="form-control" id="icon_input" value="' . $row['prod_price'] . '" name="price" placeholder="Price">
                                   </div>

                               </div>
                               
                                <div class="form-row">
                                   <div class="form-group col-md-12 icon_input_container">
                                       <img class="icon_input_img" src="../Common/assets/modal-x/img/upload.png"/>
                                       <input type="file" name="fileToUpload" class="form-control" id="icon_input" value="' . $row['prod_photo'] . '" placeholder="Product Image">
                                     
                                   </div>
                               </div>
                               
                                 <div class="form-row">
                                   <div class="form-group col-md-12 icon_input_container">
                                       
                                       <img style="width:200px !important;    border-radius:0;" src="../../Services/' . $row['prod_photo'] . '" />
                                   </div>
                               </div>
                               <div class="form-row">
                                            <div class="form-group col-md-12 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/note.png"/>
                                                <input type="number" class="form-control" id="icon_input" name="min_order_qty" placeholder="Minimum Order" value="' . $row['min_order_qty'] . '">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/note.png"/>
                                                <input type="number" class="form-control" id="icon_input" name="min_qty_alert" placeholder="Minimum Qty" value="' . $row['min_qty_alert'] . '">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12 icon_input_container">Publish';
                                                       if ($row['publish']==1) {
                                                           echo '<input type="checkbox" class="form-control" id="icon_input" name="publish" value="1" checked/>';
                                                       } else {
                                                           echo '<input type="checkbox" class="form-control" id="icon_input" name="publish" value="1"/>';
                                                       }
                                                echo '</div>
                                        </div>
                             <input type="hidden" name="prod_id" value="' . $row['prod_id'] . '"/>
<input type="hidden" name="serviceFlag" id="serviceFlag" value="EDITPROD"/>
' . $clib->get_csrf_token() . '
                               <input type="hidden" name="acc_id" id="acc_id" value="'.$acc_id.'"/>
                               <button type="submit" class="modal-x-btn" >UPDATE PRODUCT</button>
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