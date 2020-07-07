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
            <h4 class="card-title">All Materials</h4>
            <div style="display: initial;" data-placement="right" title="Add a Materials" data-toggle="tooltip"><button data-toggle="modal" data-target="#AddMaterial" type="button"  class="btn btn-inverse-primary btn-fw"><i  class="fa fa-plus"></i></button></div> 

           
              <!-- Modal Add Material-->
    <div class="modal fade "   id="AddMaterial"  tabindex="-1" role="dialog"
         aria-labelledby="AddCutterModel" aria-hidden="true">
        <div class="modal-dialog mid-size modal-lg modal-dialog-centered " role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
               <div class="container-fluid">
                   <div class="row">
                       <div class="col-md-2 d-sm-flex align-items-end round-corners-center" style="background-image: url('../Common/assets/modal-x/img/material.jpg')">
                          <div style="display:block;height:200px;"></div>
                       </div>
                      
                       <div class="col-md-10 py-5 px-sm-5 ">
                           <span class="inner-modal-title" style="text-align:left !important">Add New Material</span>
                             
                             <form class="cmxform" id="commentForm" method="post" enctype="multipart/form-data" action="../../Services/MaterialsService.php">
                               <div class="form-row">
                                
                                   <div class="form-group col-md-12 icon_input_container">
                                       <img class="icon_input_img" src="../Common/assets/modal-x/img/info.png"/>
                                       <input  type="text" name="description" class="form-control" id="icon_input" placeholder="Description" required>
                                   </div>
                                   
                                    <div class="form-group col-md-6 icon_input_container">
                                       <img class="icon_input_img" src="../Common/assets/modal-x/img/info.png"/>
                                       <input type="text" name="code" class="form-control" id="icon_input" placeholder="Code" required>
                                   </div>
                                   
                                    <div class="form-group col-md-6 icon_input_container">
                                       <img class="icon_input_img" src="../Common/assets/modal-x/img/info.png"/>
                                       <input type="text" name="cutting" class="form-control" id="icon_input" placeholder="Cutting" required>
                                   </div>
                                   
                                   <div class="form-group col-md-6 icon_input_container">
                                       <img class="icon_input_img" src="../Common/assets/modal-x/img/info.png"/>
                                       <input type="text" name="tape" class="form-control" id="icon_input" placeholder="Tape" required>
                                   </div>
                                   
                                   <div class="form-group col-md-6 icon_input_container">
                                       <img class="icon_input_img" src="../Common/assets/modal-x/img/info.png"/>
                                       <input type="text" name="aluminium"  class="form-control" id="icon_input" placeholder="Aluminium" required>
                                   </div>
                                   
                                    <div class="form-group col-md-6 icon_input_container">
                                       <img class="icon_input_img" src="../Common/assets/modal-x/img/info.png"/>
                                       <input  type="text" name="plastic"  class="form-control" id="icon_input" placeholder="Plastic" required>
                                   </div>
                                   
                                   
                                    <div class="form-group col-md-6 icon_input_container">
                                       <img class="icon_input_img" src="../Common/assets/modal-x/img/info.png"/>
                                       <input ttype="text" name="natgumtape"  class="form-control" id="icon_input" placeholder="Natgumtape" required>
                                   </div>
                                   
                                    <div class="form-group col-md-12 icon_input_container">
                                       <img class="icon_input_img" src="../Common/assets/modal-x/img/info.png"/>
                                       <input type="text" name="additional"  class="form-control" id="icon_input" placeholder="Additional" required>
                                   </div>
                                   
                               </div>
                              <span style="float:right"><button type="submit" class="modal-x-btn">ADD MATERIAL</button></span>
                              
                            <input type="hidden" name="serviceFlag" id="serviceFlag" value="ADDMATERIAL"/>
                                    <?php echo $clib->get_csrf_token(); ?>
                           </form>
                          
                       </div>
                   </div>
               </div>
            </div>
        </div>
    </div>
    <!-- Modal Ends -->
              
               <!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">

                        <form class="cmxform" id="commentForm" method="post" enctype="multipart/form-data" action="../../Services/MaterialsService.php">
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
                                                <label for="description">Description</label>
                                                <input id="description" type="text" name="description" class="form-control" required >
                                            </div>
                                            <div class="form-group">
                                                <label for="code">Code</label>
                                                <input id="code" type="text" name="code" class="form-control" required >
                                            </div>
                                            <div class="form-group">
                                                <label for="cutting">Cutting</label>
                                                <input id="cutting" type="text" name="cutting" class="form-control" required >
                                            </div>
                                            <div class="form-group">
                                                <label for="tape">Tape</label>
                                                <input id="tape" type="text" name="tape" class="form-control" required >
                                            </div>
                                            <div class="form-group">
                                                <label for="aluminium">Aluminium</label>
                                                <input id="aluminium" type="text" name="aluminium" class="form-control" required >
                                            </div>
                                            <div class="form-group">
                                                <label for="plastic">plastic</label>
                                                <input id="plastic" type="text" name="plastic" class="form-control" required >
                                            </div>
                                            <div class="form-group">
                                                <label for="natgumtape">Natgumtape</label>
                                                <input id="natgumtape" type="text" name="natgumtape" class="form-control" required >
                                            </div>
                                            <div class="form-group">
                                                <label for="additional">Additional</label>
                                                <input id="additional" type="text" name="additional" class="form-control" required >
                                            </div>                                            
                                            <div class="row" >
                                                <div class="col-md-6" >
                                                    <button type="submit" class="btn btn-inverse-dark btn-fw float-right">Add Material</button>
                                                </div>
                                            </div>

                                            <br/>
                                        </div>

                                    </div>

                                    <input type="hidden" name="serviceFlag" id="serviceFlag" value="ADDMATERIAL"/>
                                    <?php // echo $clib->get_csrf_token(); ?>
                                </fieldset>

                            </div>

                        </form>
                    </div>
                </div>
            </div> -->



            <div class="clearfix" ></div>
            <br/>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="IDM" class="table">
                            <thead>
                                <tr>
                                    <th>Material</th>
                                    <th>Description</th>
                                    <th>Cutting</th>
                                    <th>Tape</th>
                                    <th>Aluminium</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * from materials where status=1";
                                $result = $databaseConnection->openConnection()->query($query);
                                while ($row = $result->fetch_assoc()) {
                                    echo '<tr>
                                                        <td>' . $row['description'] . '</td>
                                                        <td>' . $row['code'] . '</td>
                                                            <td>' . $row['cutting'] . '</td>
                                                                <td>' . $row['tape'] . '</td>
                                                                    <td>' . $row['aluminium'] . '</td>
                                                        <td>
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <div style="display: initial;" data-placement="left" title="View & Edit Materials" data-toggle="tooltip"><button type="button" data-toggle="modal" data-target="#updtaccmodal' . $row['material_id'] . '" class="btn btn-sm btn-inverse-primary btn-fw"><i class="fa fa-pencil"></i></button></div>
                                                            <button class="btn btn-sm btn-inverse-danger btn-fw" data-placement="right" title="Delete Materials" data-toggle="tooltip"  onclick="return showSwal(' . "'warning-message-and-cancel','../../Services/MaterialsService.php?serviceFlag=DELMATERIAL&material_id=" . $row['material_id'] . "&csrf_token=" . $clib->get_csrf_token(true) . "'" . ')"><i class="fa fa-trash"></i></button>  
                                                        </div>              
<!-- Modal Add Material-->

    <div class="modal fade "  id="updtaccmodal' . $row['material_id'] . '"   tabindex="-1" role="dialog"
         aria-labelledby="AddCutterModel" aria-hidden="true">
        <div class="modal-dialog mid-size modal-lg modal-dialog-centered " role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
               <div class="container-fluid">
                   <div class="row">
                       <div class="col-md-2 d-sm-flex align-items-end round-corners-center" style="background-image: url(../Common/assets/modal-x/img/material.jpg)">
                          <div style="display:block;height:200px;"></div>
                       </div>
                      
                       <div class="col-md-10 py-5 px-sm-5 ">
                           <span class="inner-modal-title" style="text-align:left !important">Add New Material</span>
                             
                             <form class="cmxform" id="commentForm" method="post" enctype="multipart/form-data" action="../../Services/MaterialsService.php">
                               <div class="form-row">
                                
                                   <div class="form-group col-md-12 icon_input_container">
                                       <img class="icon_input_img" src="../Common/assets/modal-x/img/info.png"/>
                                       <input  type="text" value="' . $row['description'] . '" name="description" class="form-control" id="icon_input" placeholder="Description" required>
                                   </div>
                                   
                                    <div class="form-group col-md-6 icon_input_container">
                                       <img class="icon_input_img" src="../Common/assets/modal-x/img/info.png"/>
                                       <input type="text" name="code" value="' . $row['code'] . '" class="form-control" id="icon_input" placeholder="Code" required>
                                   </div>
                                   
                                    <div class="form-group col-md-6 icon_input_container">
                                       <img class="icon_input_img" src="../Common/assets/modal-x/img/info.png"/>
                                       <input type="text" name="cutting" value="' . $row['cutting'] . '"  class="form-control" id="icon_input" placeholder="Cutting" required>
                                   </div>
                                   
                                   <div class="form-group col-md-6 icon_input_container">
                                       <img class="icon_input_img" src="../Common/assets/modal-x/img/info.png"/>
                                       <input type="text" name="tape"  value="' . $row['tape'] . '"  class="form-control" id="icon_input" placeholder="Tape" required>
                                   </div>
                                   
                                   <div class="form-group col-md-6 icon_input_container">
                                       <img class="icon_input_img" src="../Common/assets/modal-x/img/info.png"/>
                                       <input type="text" name="aluminium" value="' . $row['aluminium'] . '"  class="form-control" id="icon_input" placeholder="Aluminium" required>
                                   </div>
                                   
                                    <div class="form-group col-md-6 icon_input_container">
                                       <img class="icon_input_img" src="../Common/assets/modal-x/img/info.png"/>
                                       <input  type="text" name="plastic" value="' . $row['plastic'] . '"  class="form-control" id="icon_input" placeholder="Plastic" required>
                                   </div>
                                   
                                   
                                    <div class="form-group col-md-6 icon_input_container">
                                       <img class="icon_input_img" src="../Common/assets/modal-x/img/info.png"/>
                                       <input ttype="text" name="natgumtape" value="' . $row['natgumtape'] . '"  class="form-control" id="icon_input" placeholder="Natgumtape" required>
                                   </div>
                                   
                                    <div class="form-group col-md-12 icon_input_container">
                                       <img class="icon_input_img" src="../Common/assets/modal-x/img/info.png"/>
                                       <input type="text" name="additional" value="' . $row['additional'] . '"  class="form-control" id="icon_input" placeholder="Additional" required>
                                   </div>
                                   
                               </div>
                              <span style="float:right"><button type="submit" class="modal-x-btn">EDIT MATERIAL</button></span>
                              
                            <input type="hidden" name="material_id" value="' . $row['material_id'] . '"/>
<input type="hidden" name="serviceFlag" id="serviceFlag" value="UPDTMATERIAL"/>
' . $clib->get_csrf_token() . '
                           </form>
                          
                       </div>
                   </div>
               </div>
            </div>
        </div>
    </div>
<!-- Modal Ends --> 
                                                        
                                                                <!-- <div class="modal fade" id="updtaccmodal' . $row['material_id'] . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-center" style="width: 100%;">Edit Materials</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="cmxform" id="commentForm" method="post" enctype="multipart/form-data" action="../../Services/MaterialsService.php">
                            <div class="modal-body">

                                <fieldset>
                                    <div class="container-fluid">
                                        <div class="row">
                                        <div class="col-md-12 col-lg-12">
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <input id="description" value="' . $row['description'] . '" type="text" name="description" class="form-control" required >
                                            </div>
                                            <div class="form-group">
                                                <label for="code">Code</label>
                                                <input id="code" value="' . $row['code'] . '" type="text" name="code" class="form-control" required >
                                            </div>
                                            <div class="form-group">
                                                <label for="cutting">Cutting</label>
                                                <input id="cutting" value="' . $row['cutting'] . '" type="text" name="cutting" class="form-control" required >
                                            </div>
                                            <div class="form-group">
                                                <label for="tape">Tape</label>
                                                <input id="tape" value="' . $row['tape'] . '" type="text" name="tape" class="form-control" required >
                                            </div>
                                            <div class="form-group">
                                                <label for="aluminium">Aluminium</label>
                                                <input id="aluminium" value="' . $row['aluminium'] . '" type="text" name="aluminium" class="form-control" required >
                                            </div>
                                            <div class="form-group">
                                                <label for="plastic">plastic</label>
                                                <input id="plastic" value="' . $row['plastic'] . '" type="text" name="plastic" class="form-control" required >
                                            </div>
                                            <div class="form-group">
                                                <label for="natgumtape">Natgumtape</label>
                                                <input id="natgumtape" value="' . $row['natgumtape'] . '" type="text" name="natgumtape" class="form-control" required >
                                            </div>
                                            <div class="form-group">
                                                <label for="additional">Additional</label>
                                                <input id="additional" value="' . $row['additional'] . '" type="text" name="additional" class="form-control" required >
                                            </div>
                                            
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <input type="hidden" name="material_id" value="' . $row['material_id'] . '"/>
<input type="hidden" name="serviceFlag" id="serviceFlag" value="UPDTMATERIAL"/>
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