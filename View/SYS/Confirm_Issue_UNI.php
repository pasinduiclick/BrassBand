<?php
include '../Common/header.php';
$clib->login_reqired(FALSE);
include '../Common/topmenu.php';
include '../Common/leftmenu.php';
$mem_id = $clib->input("mem_id");

$ref_number = "UNI" . date("mdhi");
?>

<div class="content-wrapper">

    <div class="card">
        <?php include '../Common/showMessage.php'; ?>
        <div class="card-body">

            <div class="row">
                <div class="col-12">
                    <form method="POST" action="../../Service/IssueService.php">
                        <div class="form-group col-md-3 icon_input_container">
                            <label for="name">Ref Number</label>
                            <input id="name" type="text" name="ref_number" class="form-control" required readonly="readonly" value="<?php echo $ref_number; ?>"/>
                            <input id="mem_id" type="hidden" name="mem_id" value="<?php echo $mem_id; ?>"/>
                        </div>
                        <div class="table-responsive hiddenoverflow">
                            <div class="container-fluid mt-5 d-flex justify-content-center w-100">
                                <div class="table-responsive w-100">
                                    <table class="table">
                                        <thead>
                                            <tr class="bg-dark text-white">
                                                <th>Type</th>
                                                <th>Sizes</th>
                                                <th>ID Mark</th> 
                                                <th>Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $arra = array_keys($_POST['qty']);
                                            $ids = implode(", ", $arra);
                                            $query2 = "select * from uniforms where uniforms.`uniform_id` IN (" . $ids . ")";
                                            $result2 = $databaseConnection->openConnection()->query($query2);
                                            $cnt = 0;
                                            $subtot = 0;

                                            while ($row2 = $result2->fetch_assoc()) {

                                                if ($_POST['qty'][$row2["uniform_id"]] != 0) {
                                                    ?>

                                                    <tr class="text-right">
                                                <input type="hidden" value="<?php echo $row2["uniform_id"]; ?>" name="uniform_id[<?php echo $row2["uniform_id"]; ?>]"/>                                            
                                                <td class="text-left"><?php echo $row2["type"]; ?></td>
                                                <td class="text-left"><?php echo $row2["sizes"]; ?></td>
                                                <td class="text-left"><?php echo $row2["id_marking"]; ?></td>
                                                <td><?php echo $_POST['qty'][$row2["uniform_id"]]; ?><input type="hidden" value="<?php echo $_POST['qty'][$row2["uniform_id"]]; ?>" name="qty[<?php echo $row2["uniform_id"]; ?>]"/></td>                                                                                        
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>

                                        <div class="form-group col-md-4 icon_input_container">
                                            <label for="name">Issue Date</label>
                                            <input id="name" type="date" name="issue_date" class="form-control" required >
                                        </div>

                                        <div class="form-group col-md-4 icon_input_container">
                                            <label for="name">Return Date</label>
                                            <input id="name" type="date" name="return_date" class="form-control" required >
                                        </div>

                                        <button type="submit" class="btn btn-inverse-primary btn-fw add-new-order-btn" name="serviceFlag" value="ISSUEUNI"><li class="fa fa-book" ></li> Submit</button>
                                                <?php echo $clib->get_csrf_token(); ?>
                                        </form>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
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
