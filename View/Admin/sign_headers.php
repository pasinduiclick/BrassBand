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
            <h4 class="card-title">All Sign Header</h4>
            <div style="display: initial;" data-placement="right" title="Add a Sign Header" data-toggle="tooltip"><button data-toggle="modal" data-target="#exampleModal" type="button"  class="btn btn-inverse-primary btn-fw"><i  class="fa fa-plus"></i></button></div> 

            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">

                        <form class="cmxform" id="commentForm" method="post" enctype="multipart/form-data" action="../../Services/SignHeadersService.php">
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
                                                <label for="Phone">Name</label>
                                                <input id="Phone" type="text" name="name" class="form-control" required >
                                            </div>

                                            <div class="form-group">
                                                <label for="notes">Photo</label>
                                                <input type="file" name="fileToUpload" class="form-control">
                                            </div>
                                            <div class="row" >
                                            <div class="col-md-6 modal-mod-footer" >
                                                <li class="fa fa-info-circle" ></li><p> By Clicking "Add a Sign Header" you confirm that the Sign Header is legitimate</p>

                                            </div>
                                            <div class="col-md-6" >
                                                <button type="submit" class="btn btn-inverse-dark btn-fw float-right">Add a Sign Header</button>
                                            </div>
                                        </div>
                                            <br/>
                                        </div>

                                    </div>
                                    <input type="hidden" name="serviceFlag" id="serviceFlag" value="ADDSIGN"/>
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
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * from signheaders where status=1";
                                $result = $databaseConnection->openConnection()->query($query);
                                while ($row = $result->fetch_assoc()) {
                                    echo '<tr>
                                                        <td><img style="width:150px; border-radius:0;" src="../../Services/' . $row['sh_img'] . '" /></td>
                                                        <td>' . $row['sh_name'] . '</td>                                                       
                                                        <td>
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <div style="display: initial;" data-placement="left" title="View & Edit sign header" data-toggle="tooltip"><button type="button" data-toggle="modal" data-target="#updtaccmodal' . $row['sh_id'] . '" class="btn btn-sm btn-inverse-primary btn-fw"><i class="fa fa-pencil"></i></button></div>
                                                            <button class="btn btn-sm btn-inverse-danger btn-fw" data-placement="right" title="Delete sign header" data-toggle="tooltip"  onclick="return showSwal(' . "'warning-message-and-cancel','../../Services/SignHeadersService.php?serviceFlag=DELSIGN&sh_id=" . $row['sh_id'] . "&csrf_token=" . $clib->get_csrf_token(true) . "'" . ')"><i class="fa fa-trash"></i></button>  
                                                        </div>
                                                           
                                                                                                                      
                                                        
                                                                <div class="modal fade" id="updtaccmodal' . $row['sh_id'] . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-center" style="width: 100%;">Edit a Sign Header</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="cmxform" id="commentForm" method="post" enctype="multipart/form-data" action="../../Services/SignHeadersService.php">
                            <div class="modal-body">

                                <fieldset>
                                    <div class="container-fluid">
                                        <div class="row">
                                            
                                            <div class="col-md-12 col-lg-12">
                                                <div class="form-group">
                                                    <label for="Phone">Name</label>
                                                    <input id="Phone" type="text" name="name" value="' . $row['sh_name'] . '" class="form-control" required >
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="notes">Photo</label>
                                                    <img style="width:200px;    border-radius:0;" src="../../Services/' . $row['sh_img'] . '" />
                                                    <br/><br/>
                                                    <div class="clearfix" ></div>
                                                    <input type="file" name="fileToUpload" class="form-control">
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <input type="hidden" name="sh_id" value="' . $row['sh_id'] . '"/>
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