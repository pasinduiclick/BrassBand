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
            <h4 class="card-title">All Sign Sizes</h4>
            <div style="display: initial;" data-placement="right" title="Add a Sign Size" data-toggle="tooltip"><button data-toggle="modal" data-target="#exampleModal" type="button"  class="btn btn-inverse-primary btn-fw"><i  class="fa fa-plus"></i></button></div> 

            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">

                        <form class="cmxform" id="commentForm" method="post" enctype="multipart/form-data" action="../../Services/SignSizesService.php">
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
                                                <label for="Phone">Width</label>
                                                <input id="Phone" type="number" name="width" class="form-control" required >
                                            </div>
                                            <div class="form-group">
                                                <label for="notes">Height</label>
                                                <input id="Phone" type="number" name="height" class="form-control" required >
                                            </div>

                                            <div class="row" >
                                                <div class="col-md-6 modal-mod-footer" >
                                                    <li class="fa fa-info-circle" ></li><p> By Clicking "Add a Sign Size" you confirm that the Sign Size is legitimate</p>

                                                </div>
                                                <div class="col-md-6" >
                                                    <button type="submit" class="btn btn-inverse-dark btn-fw float-right">Add a Sign Size</button>
                                                </div>
                                            </div>

                                            <br/>
                                        </div>

                                    </div>

                                    <input type="hidden" name="serviceFlag" id="serviceFlag" value="ADDSIZE"/>
                                    <?php echo $clib->get_csrf_token(); ?>
                                </fieldset>

                            </div>

                        </form>
                    </div>
                </div>
            </div>



            <div class="clearfix" ></div>
            <br/>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Width</th>
                                    <th>Height</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * from sign_sizes where status=1";
                                $result = $databaseConnection->openConnection()->query($query);
                                while ($row = $result->fetch_assoc()) {
                                    echo '<tr>
                                                        <td>' . $row['width'] . '</td>
                                                        <td>' . $row['height'] . '</td>                                                       
                                                        <td>
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <div style="display: initial;" data-placement="left" title="View & Edit sign" data-toggle="tooltip"><button type="button" data-toggle="modal" data-target="#updtaccmodal' . $row['size_id'] . '" class="btn btn-sm btn-inverse-primary btn-fw"><i class="fa fa-pencil"></i></button></div>
                                                            <button class="btn btn-sm btn-inverse-danger btn-fw" data-placement="right" title="Delete sign" data-toggle="tooltip"  onclick="return showSwal(' . "'warning-message-and-cancel','../../Services/SignSizesService.php?serviceFlag=DELSIZE&size_id=" . $row['size_id'] . "&csrf_token=" . $clib->get_csrf_token(true) . "'" . ')"><i class="fa fa-trash"></i></button>  
                                                        </div>
                                                           
                                                                                                                      
                                                        
                                                                <div class="modal fade" id="updtaccmodal' . $row['size_id'] . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-center" style="width: 100%;">Edit a Sign</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="cmxform" id="commentForm" method="post" enctype="multipart/form-data" action="../../Services/SignSizesService.php">
                            <div class="modal-body">

                                <fieldset>
                                    <div class="container-fluid">
                                        <div class="row">
                                            
                                            <div class="col-md-12 col-lg-12">
                                                <div class="form-group">
                                                    <label for="Phone">Title</label>
                                                    <input id="Phone" type="text" name="width" value="' . $row['width'] . '" class="form-control" required >
                                                </div>
                                                <div class="form-group">
                                                    <label for="notes">Notes</label>
                                                    <input id="Phone" type="text" name="height" value="' . $row['height'] . '" class="form-control" required >
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <input type="hidden" name="size_id" value="' . $row['size_id'] . '"/>
<input type="hidden" name="serviceFlag" id="serviceFlag" value="UPDTSIZE"/>
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
            </div>






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