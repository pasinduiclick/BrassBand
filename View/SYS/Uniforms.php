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
            <h4 class="card-title">All Uniforms</h4>
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
                                <div class="col-md-4 d-sm-flex align-items-end round-corners-center" style="background-image: url('../Common/assets/modal-x/img/uniform.jpg')">
                                    <div style="display:block;height:200px;"></div>
                                </div>

                                <div class="col-md-8 py-5 px-sm-5 ">
                                    <span class="inner-modal-title" style="text-align:left !important">Add New Uniforms</span>

                                    <form class="cmxform" id="commentForm" method="post" enctype="multipart/form-data" action="../../Service/UniformService.php">
                                        <div class="form-row">
                                            <div class="form-group col-md-12 icon_input_container">
                                                <label for="type">Type</label>
                                                <select  id="type" name="type" class="form-control" required>
                                                    <option value="">Please Select</option>
                                                    <?php
                                                    $query1 = "SELECT * from unicat where status=1";
                                                    $result1 = $databaseConnection->openConnection()->query($query1);
                                                    while ($row1 = $result1->fetch_assoc()) {
                                                        echo '<option value="' . $row1['type'] . '">' . $row1['type'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div><div class="form-group col-md-12 icon_input_container">
                                                <label for="sizes">Sizes</label>
                                                <input id="sizes" type="text" name="sizes" class="form-control" required >
                                            </div><div class="form-group col-md-12 icon_input_container">
                                                <label for="id_marking">Id Marking</label>
                                                <input id="id_marking" type="text" name="id_marking" class="form-control" required >
                                            </div>
                                        </div>
                                        <button type="submit" class="modal-x-btn" name="serviceFlag" id="serviceFlag" value="ADDNEWUNI">ADD UNIFORM</button>

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
                                    <th>Type</th>
                                    <th>Sizes</th>
                                    <th>ID Mark</th>                                  
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * from uniforms where status=1";
                                $result = $databaseConnection->openConnection()->query($query);
                                while ($row = $result->fetch_assoc()) {
                                    echo '<tr>
                                                        <td>' . $row['type'] . '</td>
                                                       <td>' . $row['sizes'] . '</td>'
                                    . '<td>' . $row['id_marking'] . '</td>'
                                    . '<td><div class="btn-group" role="group" aria-label="Basic example">
                                                            <div style="display: initial;" data-placement="left" title="View & Edit Cutter" data-toggle="tooltip"><button type="button" data-toggle="modal" data-target="#updtaccmodal' . $row['uniform_id'] . '" class="btn btn-sm btn-inverse-primary btn-fw"><i class="fa fa-pencil"></i></button></div>
                                                            <button class="btn btn-sm btn-inverse-danger btn-fw" data-placement="right" title="Delete Cutter" data-toggle="tooltip"  onclick="return showSwal(' . "'warning-message-and-cancel','../../Service/UniformService.php?serviceFlag=DELUNI&uniform_id=" . $row['uniform_id'] . "&csrf_token=" . $clib->get_csrf_token(true) . "'" . ')"><i class="fa fa-trash"></i></button>  
                                                        </div>';

                                    echo '<!-- Modal Edit Uniform-->
    <div class="modal fade "  id="updtaccmodal' . $row['uniform_id'] . '" tabindex="-1" role="dialog"
         aria-labelledby="AddCutterModel" aria-hidden="true">
        <div class="modal-dialog mid-size modal-lg modal-dialog-centered " role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
               <div class="container-fluid">
                   <div class="row">
                       <div class="col-md-4 d-sm-flex align-items-end round-corners-center" style="background-image: url(../Common/assets/modal-x/img/uniform.jpg)">
                          <div style="display:block;height:200px;"></div>
                       </div>
                      
                       <div class="col-md-8 py-5 px-sm-5 ">
                           <span class="inner-modal-title" style="text-align:left !important">Edit Instruments</span>
                             
                             <form class="cmxform" id="commentForm" method="post" enctype="multipart/form-data" action="../../Service/UniformService.php">
                                        <div class="form-row">
                                            <div class="form-group col-md-12 icon_input_container">
                                                <label for="type">Type</label>';
                                    echo '<select  id="type" name="type" class="form-control" required>';
                                    echo '<option value="' . $row['type'] . '">' . $row['type'] . '</option>';
                                    $query1 = "SELECT * from unicat where status=1";
                                    $result1 = $databaseConnection->openConnection()->query($query1);
                                    while ($row1 = $result1->fetch_assoc()) {
                                        echo '<option value="' . $row1['type'] . '">' . $row1['type'] . '</option>';
                                    }

                                    echo '</select></div><div class="form-group col-md-12 icon_input_container">
                                                <label for="sizes">Sizes</label>
                                                <input id="sizes" value="' . $row['sizes'] . '" type="text" name="sizes" class="form-control" required >
                                            </div><div class="form-group col-md-12 icon_input_container">
                                                <label for="id_marking">Id Marking</label>
                                                <input id="id_marking" value="' . $row['id_marking'] . '" type="text" name="id_marking" class="form-control" required >
                                            </div>
                                        </div>
                                        <input id="mem_id" type="hidden" name="uniform_id" value="' . $row['uniform_id'] . '" />
                                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="serviceFlag" id="serviceFlag" value="EDITUNI">Edit Uniform</button>
                            </div>';
                                    echo $clib->get_csrf_token();
                                    echo '</form>
                          
                       </div>
                   </div>
               </div>
            </div>
        </div>
    </div>
    <!-- Modal Ends -->                                                                                                                                                                                                                  
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