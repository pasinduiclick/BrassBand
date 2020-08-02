<?php
include '../Common/header.php';
$clib->login_reqired(FALSE);
include '../Common/topmenu.php';
include '../Common/leftmenu.php';
?>

<script>
    $(document).ready(function () {
        //view uniform issue history
        $('#mem_id').change(function () {
            var mem_id = $("#mem_id").val();
            var newUrl = "INS_Issue_History.php?mem_id=" + mem_id;
            $('#memView').attr("href", newUrl);
        });
    });
</script>

<div class="content-wrapper">

    <div class="card">
        <?php include '../Common/showMessage.php'; ?>
        <div class="card-body">

            <div class="row">
                <div class="col-12">

                    <div class="table-responsive hiddenoverflow">
                        <form method="POST" action="Confirm_Issue_INS.php">

                            <div class="col-md-8 py-5 px-sm-5 ">
                                <span class="inner-modal-title" style="text-align:left !important">Issue Items</span>
                                <div class="form-row">
                                    <div class="form-group col-md-12 icon_input_container">
                                        <label for="name">Member</label>
                                        <select name="mem_id" id="mem_id"  class="form-control" required>
                                            <option value="">--Please Select--</option>

                                            <?php
                                            $query1 = "SELECT * from membership where status=1";
                                            $result1 = $databaseConnection->openConnection()->query($query1);
                                            while ($row1 = $result1->fetch_assoc()) {
                                                echo '<option value="' . $row1['mem_id'] . '">' . $row1['name'] . '</option>';
                                            }
                                            ?>

                                        </select>
                                    </div>
                                    <a href="#" id="memView"class="form-group btn btn-inverse-primary btn-fw icon_input_container">View History</a>
                                </div>                                    
                            </div>

                            <table id="IDM" class="table datatable">
                                <thead>
                                    <tr>
                                        <th>Type</th>
                                        <th>Make</th>
                                        <th>Model</th>
                                        <th>Serial</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $query = "SELECT * from instruments where status=1";
                                    $result = $databaseConnection->openConnection()->query($query);
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <tr>                                                
                                            <td>
                                                <?php echo $row["type"]; ?>
                                            </td>
                                            <td>
                                                <?php echo $row["make"]; ?>
                                            </td>
                                            <td>
                                                <?php echo $row["model"]; ?>
                                            </td>
                                            <td>
                                                <?php echo $row["serial"]; ?>
                                            </td>
                                            <td><input class="form-control" type="number" name="qty[<?php echo $row["ins_id"]; ?>]" value="0" min="0" required="required" /></td>
                                        </tr>
                                    <?php }
                                    ?>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-inverse-primary btn-fw add-new-order-btn"><li class="fa fa-book" ></li> Submit an Order</button>
                                    <?php echo $clib->get_csrf_token(); ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

<?php
include '../Common/footer.php';
include '../Common/jsplugins.php';
?>
