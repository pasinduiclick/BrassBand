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
            <h4 class="card-title">Additional Materials</h4>
            <div style="display: initial;" data-placement="right" title="Add a Materials" data-toggle="tooltip"><button data-toggle="modal" data-target="#AdditionalMaterial" type="button"  class="btn btn-inverse-primary btn-fw"><i  class="fa fa-plus"></i></button></div> 

          
            <!-- Modal Additional Material-->
    <div class="modal fade "   id="AdditionalMaterial"  tabindex="-1" role="dialog"
         aria-labelledby="AdditionalMaterialModel" aria-hidden="true">
        <div class="modal-dialog mid-size modal-lg modal-dialog-centered " role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
               <div class="container-fluid">
                   <div class="row">
                       <div class="col-md-2 d-sm-flex align-items-end round-corners-center" style="background-image: url('../Common/assets/modal-x/img/AdditionalMaterial.jpg')">
                          <div style="display:block;height:200px;"></div>
                       </div>
                      
                       <div class="col-md-10 py-5 px-sm-5 ">
                           <span class="inner-modal-title" style="text-align:left !important">Add New Additional Material</span>
                             
                             <form class="cmxform" id="commentForm" method="post" enctype="multipart/form-data" action="../../Services/AdditionalMaterialsService.php">
                               <div class="form-row">
                                
                                   <div class="form-group col-md-12 icon_input_container">
                                       <img class="icon_input_img" src="../Common/assets/modal-x/img/info.png"/>
                                       <input  type="text" name="name" class="form-control" id="icon_input" placeholder="Name" required>
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
                                       <input ttype="text" name="natgum_tape"  class="form-control" id="icon_input" placeholder="Natgumtape" required>
                                   </div>
                                   
                                    <div class="form-group col-md-12 icon_input_container">
                                       <img class="icon_input_img" src="../Common/assets/modal-x/img/info.png"/>
                                       <input type="text" name="note"  class="form-control" id="icon_input" placeholder="Note" required>
                                   </div>
                                   
                               </div>
                              <span style="float:right"><button type="submit" class="modal-x-btn">ADD ADDITIONAL MATERIAL</button></span>
                              
                            <input type="hidden" name="serviceFlag" id="serviceFlag" value="ADDADDIMATERIAL"/>
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

                        <form class="cmxform" id="commentForm" method="post" enctype="multipart/form-data" action="../../Services/AdditionalMaterialsService.php">
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
                                                <label for="name">Name</label>
                                                <input id="name" type="text" name="name" class="form-control" required >
                                            </div><div class="form-group">
                                                <label for="tape">Tape</label>
                                                <input id="tape" type="text" name="tape" class="form-control" required >
                                            </div><div class="form-group">
                                                <label for="aluminium">Aluminium</label>
                                                <input id="aluminium" type="text" name="aluminium" class="form-control" required >
                                            </div><div class="form-group">
                                                <label for="plastic">Plastic</label>
                                                <input id="plastic" type="text" name="plastic" class="form-control" required >
                                            </div><div class="form-group">
                                                <label for="natgum_tape">Natgum Tape</label>
                                                <input id="natgum_tape" type="text" name="natgum_tape" class="form-control" required >
                                            </div><div class="form-group">
                                                <label for="note">Note</label>
                                                <input id="note" type="text" name="note" class="form-control" required >
                                            </div>                                        
                                            <div class="row" >
                                                <div class="col-md-6" >
                                                    <button type="submit" class="btn btn-inverse-dark btn-fw float-right">Add Material</button>
                                                </div>
                                            </div>

                                            <br/>
                                        </div>

                                    </div>

                                    <input type="hidden" name="serviceFlag" id="serviceFlag" value="ADDADDIMATERIAL"/>
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
                        <table class="table" id="IDM">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Tape</th>
                                    <th>Aluminium</th>
                                    <th>Plastic</th>
                                    <th>Natgum</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * from additional_materials where status=1";
                                $result = $databaseConnection->openConnection()->query($query);
                                while ($row = $result->fetch_assoc()) {
                                    echo '<tr>
                                                        <td>' . $row['name'] . '</td>
                                                        <td>' . $row['tape'] . '</td>
                                                            <td>' . $row['aluminium'] . '</td>
                                                                <td>' . $row['plastic'] . '</td>
                                                                    <td>' . $row['natgum_tape'] . '</td>
                                                        <td>
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <div style="display: initial;" data-placement="left" title="View & Edit Materials" data-toggle="tooltip"><button type="button" data-toggle="modal" data-target="#updtaccmodal' . $row['add_mat_id'] . '" class="btn btn-sm btn-inverse-primary btn-fw"><i class="fa fa-pencil"></i></button></div>
                                                            <button class="btn btn-sm btn-inverse-danger btn-fw" data-placement="right" title="Delete Materials" data-toggle="tooltip"  onclick="return showSwal(' . "'warning-message-and-cancel','../../Services/AdditionalMaterialsService.php?serviceFlag=DELADDIMATERIAL&add_mat_id=" . $row['add_mat_id'] . "&csrf_token=" . $clib->get_csrf_token(true) . "'" . ')"><i class="fa fa-trash"></i></button>  
                                                        </div>
                                                           
       <!-- Modal Additional Material-->
    <div class="modal fade "  id="updtaccmodal' . $row['add_mat_id'] . '"  tabindex="-1" role="dialog"
         aria-labelledby="AdditionalMaterialModel" aria-hidden="true">
        <div class="modal-dialog mid-size modal-lg modal-dialog-centered " role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
               <div class="container-fluid">
                   <div class="row">
                       <div class="col-md-2 d-sm-flex align-items-end round-corners-center" style="background-image: url(../Common/assets/modal-x/img/AdditionalMaterial.jpg)">
                          <div style="display:block;height:200px;"></div>
                       </div>
                      
                       <div class="col-md-10 py-5 px-sm-5 ">
                           <span class="inner-modal-title" style="text-align:left !important">Edit Additional Material</span>
                             
                             <form class="cmxform" id="commentForm" method="post" enctype="multipart/form-data" action="../../Services/AdditionalMaterialsService.php">
                               <div class="form-row">
                                
                                   <div class="form-group col-md-12 icon_input_container">
                                       <img class="icon_input_img" src="../Common/assets/modal-x/img/info.png"/>
                                       <input  type="text" name="name" value="' . $row['name'] . '" class="form-control" id="icon_input" placeholder="Name" required>
                                   </div>
                                   
                                   <div class="form-group col-md-6 icon_input_container">
                                       <img class="icon_input_img" src="../Common/assets/modal-x/img/info.png"/>
                                       <input type="text" name="tape" value="' . $row['tape'] . '" class="form-control" id="icon_input" placeholder="Tape" required>
                                   </div>
                                   
                                     <div class="form-group col-md-6 icon_input_container">
                                       <img class="icon_input_img" src="../Common/assets/modal-x/img/info.png"/>
                                       <input type="text" name="aluminium" value="' . $row['aluminium'] . '"  class="form-control" id="icon_input" placeholder="Aluminium" required>
                                   </div>
                                   
                                   <div class="form-group col-md-6 icon_input_container">
                                       <img class="icon_input_img" src="../Common/assets/modal-x/img/info.png"/>
                                       <input  type="text" name="plastic"  value="' . $row['plastic'] . '" class="form-control" id="icon_input" placeholder="Plastic" required>
                                   </div>
                                   
                                    <div class="form-group col-md-6 icon_input_container">
                                       <img class="icon_input_img" src="../Common/assets/modal-x/img/info.png"/>
                                       <input ttype="text" name="natgum_tape" value="' . $row['natgum_tape'] . '" class="form-control" id="icon_input" placeholder="Natgumtape" required>
                                   </div>
                                   
                                    <div class="form-group col-md-12 icon_input_container">
                                       <img class="icon_input_img" src="../Common/assets/modal-x/img/info.png"/>
                                       <input type="text" name="note"  value="' . $row['note'] . '" class="form-control" id="icon_input" placeholder="Note" required>
                                   </div>
                                   
                               </div>
                              <span style="float:right"><button type="submit" class="modal-x-btn">EDIT ADDITIONAL MATERIAL</button></span>
                              
                                    <input type="hidden" name="add_mat_id" value="' . $row['add_mat_id'] . '"/>
<input type="hidden" name="serviceFlag" id="serviceFlag" value="UPDTADDIMATERIAL"/>
' . $clib->get_csrf_token() . '
                           </form>
                          
                       </div>
                   </div>
               </div>
            </div>
        </div>
    </div>
    <!-- Modal Ends -->                                                                                                                   
                                                        
                                                              <!--  <div class="modal fade" id="updtaccmodal' . $row['add_mat_id'] . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-center" style="width: 100%;">Edit Materials</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="cmxform" id="commentForm" method="post" enctype="multipart/form-data" action="../../Services/AdditionalMaterialsService.php">
                            <div class="modal-body">

                                <fieldset>
                                    <div class="container-fluid">
                                        <div class="row">
                                        <div class="col-md-12 col-lg-12">
                                            
<div class="form-group">
                    <label for="name">Name</label>
                    <input id="name" value="' . $row['name'] . '" type="text" name="name" class="form-control" required >
        </div><div class="form-group">
                    <label for="tape">Tape</label>
                    <input id="tape" value="' . $row['tape'] . '" type="text" name="tape" class="form-control" required >
        </div><div class="form-group">
                    <label for="aluminium">Aluminium</label>
                    <input id="aluminium" value="' . $row['aluminium'] . '" type="text" name="aluminium" class="form-control" required >
        </div><div class="form-group">
                    <label for="plastic">Plastic</label>
                    <input id="plastic" value="' . $row['plastic'] . '" type="text" name="plastic" class="form-control" required >
        </div><div class="form-group">
                    <label for="natgum_tape">Natgum Tape</label>
                    <input id="natgum_tape" value="' . $row['natgum_tape'] . '" type="text" name="natgum_tape" class="form-control" required >
        </div><div class="form-group">
                    <label for="note">Note</label>
                    <input id="note" value="' . $row['note'] . '" type="text" name="note" class="form-control" required >
        </div>                                            

                                            </div>
                                            
                                        </div>
                                    </div>
                                    <input type="hidden" name="add_mat_id" value="' . $row['add_mat_id'] . '"/>
<input type="hidden" name="serviceFlag" id="serviceFlag" value="UPDTADDIMATERIAL"/>
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