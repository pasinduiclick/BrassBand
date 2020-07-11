<?php
include '../Common/header.php';
$clib->login_reqired(FALSE);
include '../Common/topmenu.php';
include '../Common/leftmenu.php';
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
                                    <th>Member</th>    
                                    <th>Type</th>    
                                    <th>Issue Date</th>
                                    <th>Return Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $query = "select * from notifications n, membership m WHERE n.member=m.mem_id AND n.status = 1 GROUP BY n.ref_number";
                                $result = $databaseConnection->openConnection()->query($query);
                                while ($row = $result->fetch_assoc()) {
                                    echo '<tr>
                                                        <td>' . $row['ref_number'] . '</td>
                                                       <td>' . $row['name'] . '</td>'
                                            .'<td>' . $row['type'] . '</td>'
                                    . '<td>' . $row['issue_date'] . '</td>'
                                    . '<td>' . $row['return_date'] . '</td>'
                                    . '<td><div class="btn-group" role="group" aria-label="Basic example">                                                            
                                                            <button class="btn btn-sm btn-inverse-danger btn-fw" data-placement="right" title="Clear" data-toggle="tooltip"  onclick="return showSwal(' . "'warning-message-and-cancel','../../Service/IssueService.php?serviceFlag=CLEARNOTIFY&ref_number=" . $row['ref_number'] . "&csrf_token=" . $clib->get_csrf_token(true) . "'" . ')"><i class="fa fa-trash"></i></button>  
                                                        </div></td><tr>';
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