<?php
include '../Common/header.php';
$clib->login_reqired(FALSE);
include '../Common/topmenu.php';
include '../Common/leftmenu.php';
$mem_id = $_GET['mem_id'];
?>

<div class="content-wrapper">

    <div class="card">
        <?php include '../Common/showMessage.php'; ?>
        <div class="card-body">

            <div class="row">
                <div class="col-12">

                    <div class="table-responsive hiddenoverflow">

                        <table id="IDM" class="table">
                            <thead>
                                <tr>
                                    <th>Ref Number</th>
                                    <th>Type</th>
                                    <th>Sizes</th>
                                    <th>ID Mark</th> 
                                    <th>Issue Date</th>
                                    <th>Return Date</th>
                                    <th>Quantity</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $query = "SELECT *,iu.status AS SS FROM issue_uniform iu, membership m, uniforms u WHERE iu.mem_id=m.mem_id AND iu.uniform_id=u.uniform_id AND iu.mem_id='$mem_id' ORDER BY iu.issue_date DESC";
                                $result = $databaseConnection->openConnection()->query($query);
                                while ($row = $result->fetch_assoc()) {
                                    echo '<tr>
                                                        <td>' . $row['ref_number'] . '</td>
                                                       <td>' . $row['type'] . '</td>'
                                    . '<td>' . $row['sizes'] . '</td>' .
                                    '<td>' . $row['id_marking'] . '</td>'
                                    . '<td>' . $row['issue_date'] . '</td>'
                                    . '<td>' . $row['return_date'] . '</td>'
                                    . '<td>' . $row['qty'] . '</td>'
                                    . '<td><div class="btn-group" role="group" aria-label="Basic example">';
                                    if ($row['SS'] == 1) {
                                        echo '<button class="btn btn-sm btn-inverse-danger btn-fw" data-placement="right" title="Item Returned" data-toggle="tooltip"  onclick="return showSwal(' . "'warning-message-and-cancel','../../Service/IssueService.php?serviceFlag=UNIRETURN&ref_number=" . $row['ref_number'] . "&csrf_token=" . $clib->get_csrf_token(true) . "'" . ')"><i class="fa fa-archive"></i></button>';
                                    } else {
                                        echo '<b style="color:green">Returned</b>';
                                    }
                                    echo '</div></td><tr>';
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

<?php
include '../Common/footer.php';
include '../Common/jsplugins.php';
?>