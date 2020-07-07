<?php
include '../Common/header.php';
$clib->login_reqired(TRUE);
include '../Common/topmenu.php';
include '../Common/leftmenu.php';
?>

<div class="content-wrapper">
    <div class="card" >
        <div class="card-body">
            <h3 class="card-title">Orders</h3>
            <div class="col-md-12 col-lg-12">
                <div class="hr-sect">Advance Search</div>
                <form method="POST" action="SearchOrders.php" >
                    <div  class="row" >

                        <div class="col-md-4 col-lg-4" >
                            <div id="datepicker-popup" class="input-group date datepicker">
                                <input type="text" name="fromdt" placeholder="Order Required From" class="form-control">
                                <span class="input-group-addon input-group-append border-left">
                                    <span class="ti-calendar input-group-text"></span>
                                </span>
                            </div>
                            <br/>
                            <div id="datepicker-popup2" class="input-group date datepicker">
                                <input type="text" name="todt" placeholder="Order Required To" class="form-control">
                                <span class="input-group-addon input-group-append border-left">
                                    <span class="ti-calendar input-group-text"></span>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4" >
                            <div class="form-group">
                                <select name="acc_id" id="acc_id" class="form-control select2" >
                                    <option disabled="" selected="">Search by Account</option>
                                    <?php
                                    $query = "SELECT * from accounts where status=1";
                                    $result = $databaseConnection->openConnection()->query($query);
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<option value="' . $row['acc_id'] . '" >' . $row['business_name'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>

                            <select name="status" id="status" class="form-control select2" >
                                <option disabled="" selected="">Search by Status</option>
                                <option value="1" >Pending Confirmation</option>
                                <option value="2" >Confirmed and transfer to Quotation</option>
                                <option value="3" >Transfered to Supplier</option>
                                <option value="4" >Completed</option>
                                <option value="0" >Rejected</option>
                            </select>
                        </div>
                        <div class="col-md-4 col-lg-4" >
                            <div class="form-group">
                                <input type="text" name="reff" class="form-control" placeholder="Search by Reference ID" />
                            </div>
                            <button type="submit" style="width: 100%;" value="sub" name="subbut" class="btn btn-inverse-dark" > <li class="fa fa-search" ></li> Search</button>
                        </div>

                    </div>
                </form>
                <hr/>
            </div>
            <table id="IDM" class="table table-hover">
                <thead>
                    <tr>
                        <th>
                            Ref #
                        </th>
                        <th>
                            Date
                        </th>
                        <th>
                            Customer 
                        </th>
                        <th>
                            Invoice
                        </th>
                        <th>
                            Total
                        </th>
                        <th>
                            Status
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $query = "select * from orders where order_id !='0' ";
                    $isnd = FALSE;
                    if (isset($_POST["subbut"])) {

                        if (isset($_POST["fromdt"]) & isset($_POST["todt"]) & !empty($_POST["fromdt"]) & !empty($_POST["todt"])) {
                            $isnd = TRUE;
                            $fromdt = date("Y-m-d", strtotime($_POST["fromdt"]));
                            $todt = date("Y-m-d", strtotime($_POST["todt"]));
                            $query .= "AND order_date BETWEEN '" . $fromdt . " 00:00:01' AND '" . $todt . " 23:59:59' ";
                        }

                        if (isset($_POST["acc_id"]) & !empty($_POST["acc_id"])) {
                            $query .= "AND acc_id=" . $_POST["acc_id"] . " ";
                        }
                        if (isset($_POST["status"]) & !empty($_POST["status"])) {
                            $query .= "AND status=" . $_POST["status"] . " ";
                        }
                        if (isset($_POST["reff"]) & !empty($_POST["reff"])) {
                            $query .= "AND order_number=" . $_POST["reff"] . " ";
                        }
                    }

                    $query = $query . " GROUP BY order_number";
                    $result4 = $databaseConnection->openConnection()->query($query);
                    while ($row4 = $result4->fetch_assoc()) {
                        ?>

                        <tr>
                            <td><?php echo $row4["order_number"]; ?></td>
                            <td><?php echo substr($row4["order_date"], 0, 10); ?></td>
                            <td><?php echo $row4["contact_name"]; ?></td>
                            <td>Invoice Number</td>
                            <td><?php echo $row4["total"]; ?></td>
                            <td>
                                <div class="progress">
                                    <?php
                                    $status = $row4['status'];
                                    $updated = $row4['updated'];
                                    include '../Common/status_progress.php';
                                    ?>                                    
                                </div>
                            </td>
                            <td>
                                <div style="display: initial;" data-placement="right" title="View" data-toggle="tooltip"><a href="viewOrder.php?order_number=<?php echo $row4["order_number"]; ?>" class="btn btn-inverse-primary btn-sm" ><li class="fa fa-search" ></li></a></div>
                                <?='<button class="btn btn-sm btn-inverse-danger btn-fw" data-placement="right" title="Delete this Order" data-toggle="tooltip"  onclick="return showSwal(' . "'warning-message-and-cancel','../../Services/OrderService.php?serviceFlag=REJECTORDER_ADMIN&order_number=" . $row['order_number'] . "&csrf_token=" . $clib->get_csrf_token(true) . "'" . ')"><i class="fa fa-trash"></i></button>'?>
                            </td>
                        </tr>


                    <?php }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include '../Common/footer.php';
include '../Common/jsplugins.php';
?>
