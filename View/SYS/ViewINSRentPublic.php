<?php
include '../Common/header.php';
$ref_number = $_GET['ref_number'];
?>
<!-- partial -->

<div class="content-wrapper">

    <div class="card" >
        <?php include '../Common/showMessage.php'; ?>
        <div class="card-body" >            
            <div class="clearfix" ></div>
            <?php
            echo '<h4 class="card-title">Ref Number : ' . $ref_number . '</h4>';
            ?>
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
                                    <th>Issue Date</th>
                                    <th>Return Date</th>                                  
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM issue_ins ii, membership m, instruments i WHERE ii.mem_id=m.mem_id AND ii.ins_id=i.ins_id AND ii.ref_number='$ref_number' ORDER BY ii.issue_date DESC";
                                $result = $databaseConnection->openConnection()->query($query);
                                if ($row1 = $result->fetch_assoc()) {
                                    echo '<h4 class="card-title">Rented Instruments of ' . $row1['name'] . '</h4>';
                                }

                                $query = "SELECT * FROM issue_ins ii, membership m, instruments i WHERE ii.mem_id=m.mem_id AND ii.ins_id=i.ins_id AND ii.ref_number='$ref_number' ORDER BY ii.issue_date DESC";
                                $result = $databaseConnection->openConnection()->query($query);
                                while ($row = $result->fetch_assoc()) {
                                    echo '<tr>                                                       
                                                       <td>' . $row['type'] . '</td>'
                                    . '<td>' . $row['make'] . '</td>' .
                                    '<td>' . $row['model'] . '</td>'
                                    . '<td>' . $row['serial'] . '</td>'
                                    . '<td>' . $row['issue_date'] . '</td>'
                                    . '<td>' . $row['return_date'] . '</td>';
                                    echo '<tr>';
                                }
                                ?>                                                    
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <p style="margin-top: 20px">Please contact Marlborough Brass Band for further details.</p>
</div>
<!-- content-wrapper ends -->
<?php
include '../Common/footer.php';
include '../Common/jsplugins.php';
?>