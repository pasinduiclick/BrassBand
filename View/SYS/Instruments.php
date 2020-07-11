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
            <h4 class="card-title">All Instruments</h4>
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
                                <div class="col-md-4 d-sm-flex align-items-end round-corners-center" style="background-image: url('../Common/assets/modal-x/img/instrument.png')">
                                    <div style="display:block;height:200px;"></div>
                                </div>

                                <div class="col-md-8 py-5 px-sm-5 ">
                                    <span class="inner-modal-title" style="text-align:left !important">Add New Instrument</span>

                                    <form class="cmxform" id="commentForm" method="post" enctype="multipart/form-data" action="../../Service/InstrumentService.php">
                                        <div class="form-row">
                                            <div class="form-group col-md-6 icon_input_container">
                                                <label for="type">Type</label>
                                                <input id="type" type="text" name="type" class="form-control" required >
                                            </div><div class="form-group col-md-6 icon_input_container">
                                                <label for="make">Make</label>
                                                <input id="make" type="text" name="make" class="form-control" required >
                                            </div><div class="form-group col-md-6 icon_input_container">
                                                <label for="model">Model</label>
                                                <input id="model" type="text" name="model" class="form-control" required >
                                            </div><div class="form-group col-md-6 icon_input_container">
                                                <label for="serial">Serial</label>
                                                <input id="serial" type="text" name="serial" class="form-control" required >
                                            </div><div class="form-group col-md-6 icon_input_container">
                                                <label for="euphonium">Euphonium</label>
                                                <input id="euphonium" type="text" name="euphonium" class="form-control" required >
                                            </div><div class="form-group col-md-6 icon_input_container">
                                                <label for="mouthpiece">Mouthpiece</label>
                                                <input id="mouthpiece" type="text" name="mouthpiece" class="form-control" required >
                                            </div><div class="form-group col-md-6 icon_input_container">
                                                <label for="lyre">Lyre</label>
                                                <input id="lyre" type="text" name="lyre" class="form-control" required >
                                            </div><div class="form-group col-md-6 icon_input_container">
                                                <label for="cases">Cases</label>
                                                <input id="cases" type="text" name="cases" class="form-control" required >
                                            </div><div class="form-group col-md-6 icon_input_container">
                                                <label for="marching_strap">Marching_strap</label>
                                                <input id="marching_strap" type="text" name="marching_strap" class="form-control" required >
                                            </div>
                                        </div>
                                        <button type="submit" class="modal-x-btn" name="serviceFlag" id="serviceFlag" value="ADDNEWINS">ADD MEMBER</button>

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
                                    <th>Type</th>
                                    <th>Make</th>
                                    <th>Model</th>
                                    <th>Serial</th>                                   
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * from instruments where status=1";
                                $result = $databaseConnection->openConnection()->query($query);
                                while ($row = $result->fetch_assoc()) {
                                    echo '<tr>
                                                        <td>' . $row['type'] . '</td>
                                                       <td>' . $row['make'] . '</td>'
                                    . '<td>' . $row['model'] . '</td>'
                                    . '<td>' . $row['serial'] . '</td>'
                                    . '<td><div class="btn-group" role="group" aria-label="Basic example">
                                                            <div style="display: initial;" data-placement="left" title="View & Edit Cutter" data-toggle="tooltip"><button type="button" data-toggle="modal" data-target="#updtaccmodal' . $row['ins_id'] . '" class="btn btn-sm btn-inverse-primary btn-fw"><i class="fa fa-pencil"></i></button></div>
                                                            <button class="btn btn-sm btn-inverse-danger btn-fw" data-placement="right" title="Delete Cutter" data-toggle="tooltip"  onclick="return showSwal(' . "'warning-message-and-cancel','../../Service/InstrumentService.php?serviceFlag=DELINS&ins_id=" . $row['ins_id'] . "&csrf_token=" . $clib->get_csrf_token(true) . "'" . ')"><i class="fa fa-trash"></i></button>  
                                                        </div>';

                                    echo '<!-- Modal Edit Instrument-->
    <div class="modal fade "  id="updtaccmodal' . $row['ins_id'] . '" tabindex="-1" role="dialog"
         aria-labelledby="AddCutterModel" aria-hidden="true">
        <div class="modal-dialog mid-size modal-lg modal-dialog-centered " role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
               <div class="container-fluid">
                   <div class="row">
                       <div class="col-md-4 d-sm-flex align-items-end round-corners-center" style="background-image: url(../Common/assets/modal-x/img/instrument.png)">
                          <div style="display:block;height:200px;"></div>
                       </div>
                      
                       <div class="col-md-8 py-5 px-sm-5 ">
                           <span class="inner-modal-title" style="text-align:left !important">Edit Instruments</span>
                             
                             <form class="cmxform" id="commentForm" method="post" enctype="multipart/form-data" action="../../Service/InstrumentService.php">
                                        <div class="form-row">
                                            <div class="form-group col-md-6 icon_input_container">
                                                <label for="type">Type</label>
                                                <input id="type" value="' . $row['type'] . '" type="text" name="type" class="form-control" required >
                                            </div><div class="form-group col-md-6 icon_input_container">
                                                <label for="make">Make</label>
                                                <input id="make" value="' . $row['make'] . '" type="text" name="make" class="form-control" required >
                                            </div><div class="form-group col-md-6 icon_input_container">
                                                <label for="model">Model</label>
                                                <input id="model" value="' . $row['model'] . '" type="text" name="model" class="form-control" required >
                                            </div><div class="form-group col-md-6 icon_input_container">
                                                <label for="serial">Serial</label>
                                                <input id="serial" value="' . $row['serial'] . '" type="text" name="serial" class="form-control" required >
                                            </div><div class="form-group col-md-6 icon_input_container">
                                                <label for="euphonium">Euphonium</label>
                                                <input id="euphonium" value="' . $row['euphonium'] . '" type="text" name="euphonium" class="form-control" required >
                                            </div><div class="form-group col-md-6 icon_input_container">
                                                <label for="mouthpiece">Mouthpiece</label>
                                                <input id="mouthpiece" value="' . $row['mouthpiece'] . '" type="text" name="mouthpiece" class="form-control" required >
                                            </div><div class="form-group col-md-6 icon_input_container">
                                                <label for="lyre">Lyre</label>
                                                <input id="lyre" value="' . $row['lyre'] . '" type="text" name="lyre" class="form-control" required >
                                            </div><div class="form-group col-md-6 icon_input_container">
                                                <label for="cases">Cases</label>
                                                <input id="cases" value="' . $row['cases'] . '" type="text" name="cases" class="form-control" required >
                                            </div><div class="form-group col-md-6 icon_input_container">
                                                <label for="marching_strap">Marching_strap</label>
                                                <input id="marching_strap" value="' . $row['marching_strap'] . '" type="text" name="marching_strap" class="form-control" required >
                                            </div>
                                        </div>
                                        <input id="mem_id" type="hidden" name="ins_id" value="' . $row['ins_id'] . '" />
                                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="serviceFlag" id="serviceFlag" value="EDITINS">Edit Instrument</button>
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