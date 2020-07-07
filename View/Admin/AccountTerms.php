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
            <h4 class="card-title">All Account Terms</h4>
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
                                    <span class="inner-modal-title" style="text-align:left !important">Add New Account Term</span>

                                    <form class="cmxform" id="commentForm" method="post" enctype="multipart/form-data" action="../../Services/AccountsService.php">
                                        <div class="form-row">

                                            <div class="form-group col-md-12 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/cost.png"/>
                                                <input type="text" name="term_name" class="form-control" id="term_name" placeholder="Term name" required>
                                            </div>
                                        </div>
                                        <button type="submit" class="modal-x-btn" name="serviceFlag" id="serviceFlag" value="ADDACCTERMS">ADD TERM</button>

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
                                    <th>Account Term</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * from acc_terms where status=1";
                                $result = $databaseConnection->openConnection()->query($query);
                                while ($row = $result->fetch_assoc()) {
                                    echo '<tr>
                                                        <td>' . $row['term_name'] . '</td>
                                                        <td><div class="btn-group" role="group" aria-label="Basic example">
                                                            <button class="btn btn-sm btn-inverse-danger btn-fw" data-placement="right" title="Delete Account Term" data-toggle="tooltip"  onclick="return showSwal(' . "'warning-message-and-cancel','../../Services/AccountsService.php?serviceFlag=DELACCTERM&acc_term_id=" . $row['acc_term_id'] . "&csrf_token=" . $clib->get_csrf_token(true) . "'" . ')"><i class="fa fa-trash"></i></button>  
                                                        </div></td></tr>';
                                }
                                ?>                                                    
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="card" >
        <?php include '../Common/showMessage.php'; ?>
        <div class="card-body" >
            <h4 class="card-title">All Account Categories</h4>
            <div style="display: initial;" data-placement="right" title="Add a Term" data-toggle="tooltip"><button data-toggle="modal" data-target="#categoryForm" type="button"  class="btn btn-inverse-primary btn-fw"><i  class="fa fa-plus"></i></button></div> 

            <!-- Modal Add Customer-->
            <div class="modal fade "   id="categoryForm"  tabindex="-1" role="dialog"
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
                                    <span class="inner-modal-title" style="text-align:left !important">Add New Account Category</span>

                                    <form class="cmxform" id="categoryForm" method="post" enctype="multipart/form-data" action="../../Services/AccountsService.php">
                                        <div class="form-row">

                                            <div class="form-group col-md-12 icon_input_container">
                                                <img class="icon_input_img" src="../Common/assets/modal-x/img/cost.png"/>
                                                <input type="text" name="category_name" class="form-control" id="category_name" placeholder="Category name" required>
                                            </div>
                                        </div>
                                        <button type="submit" class="modal-x-btn" name="serviceFlag" id="serviceFlag" value="ADDACCCATEGORY">Add Category</button>

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
                                    <th>Account Category</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * from acc_category where status=1";
                                $result = $databaseConnection->openConnection()->query($query);
                                while ($row = $result->fetch_assoc()) {
                                    echo '<tr>
                                                        <td>' . $row['category_name'] . '</td>
                                                        <td><div class="btn-group" role="group" aria-label="Basic example">
                                                            <button class="btn btn-sm btn-inverse-danger btn-fw" data-placement="right" title="Delete Account Category" data-toggle="tooltip"  onclick="return showSwal(' . "'warning-message-and-cancel','../../Services/AccountsService.php?serviceFlag=DELACCCATEGORY&acc_cat_id=" . $row['acc_cat_id'] . "&csrf_token=" . $clib->get_csrf_token(true) . "'" . ')"><i class="fa fa-trash"></i></button>  
                                                        </div></td></tr>';
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