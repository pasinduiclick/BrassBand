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
            <h4 class="card-title">All Music</h4>            
            <?php
            if ($_SESSION['user_type'] == 1) {
                echo '<div style="display: initial;" data-placement="right" title="Add Music" data-toggle="tooltip"><button data-toggle="modal" data-target="#AddCutter" type="button"  class="btn btn-inverse-primary btn-fw"><i  class="fa fa-plus"></i></button></div>';
            }
            ?>
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
                                <div class="col-md-4 d-sm-flex align-items-end round-corners-center" style="background-image: url('../Common/assets/modal-x/img/musica.jpg')">
                                    <div style="display:block;height:200px;"></div>
                                </div>

                                <div class="col-md-8 py-5 px-sm-5 ">
                                    <span class="inner-modal-title" style="text-align:left !important">Add New Music</span>

                                    <form class="cmxform" id="commentForm" method="post" enctype="multipart/form-data" action="../../Service/MusicService.php">
                                        <div class="form-row">
                                            <div class="form-group col-md-12 icon_input_container">
                                                <label for="name">Name</label>
                                                <input id="name" type="text" name="name" class="form-control" required >
                                            </div><div class="form-group col-md-12 icon_input_container">
                                                <label for="genre">Genre</label>
                                                <select id="genre" name="genre" class="form-control" required>
                                                    <option value="">-- Select --</option>
                                                    <option value="March">March</option>
                                                    <option value="Jazz">Jazz</option>
                                                    <option value="Test">Test</option>
                                                    <option value="Classical">Classical</option>
                                                    <option value="Light">Light</option>
                                                    <option value="Popular">Popular</option>
                                                    <option value="Other">Other</option>
                                                </select>                                                
                                            </div><div class="form-group col-md-12 icon_input_container">
                                                <label for="composer">Composer</label>
                                                <input id="composer" type="text" name="composer" class="form-control" required >
                                            </div><div class="form-group col-md-12 icon_input_container">
                                                <label for="arranger">Arranger</label>
                                                <input id="arranger" type="text" name="arranger" class="form-control" required >
                                            </div><div class="form-group col-md-12 icon_input_container">
                                                <label for="file_number">File Number</label>
                                                <input id="file_number" type="text" name="file_number" class="form-control" required >
                                            </div>
                                            <div class="form-group col-md-12 icon_input_container">
                                                <label for="music_file">Music File</label>
                                                <input id="music_file" type="file" name="music_file" class="form-control" required >
                                            </div>
                                        </div>
                                        <button type="submit" class="modal-x-btn" name="serviceFlag" id="serviceFlag" value="ADDNEWMUSIC">ADD MUSIC</button>

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
                        <table id="IDM" class="table datatable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Genre</th>
                                    <th>Composer</th>                                  
                                    <th>Arranger</th>                                     
                                    <?php
                                    if ($_SESSION['user_type'] == 1) {
                                        echo '<th>File Number</th>';
                                        echo '<th>Action</th>';
                                    }
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * from music where status=1";
                                $result = $databaseConnection->openConnection()->query($query);
                                while ($row = $result->fetch_assoc()) {
                                    echo '<tr>
                                                        <td>' . $row['name'] . '</td>
                                                       <td>' . $row['genre'] . '</td>'
                                    . '<td>' . $row['composer'] . '</td>' . '<td>' . $row['arranger'] . '</td>';
                                    if ($_SESSION['user_type'] == 1) {
                                        echo '<td><a href="../../Service/' . $row['music_file'] . '" target="blank">' . $row['file_number'] . '</a></td>'
                                        . '<td><div class="btn-group" role="group" aria-label="Basic example">
                                                            <div style="display: initial;" data-placement="left" title="View & Edit Music" data-toggle="tooltip"><button type="button" data-toggle="modal" data-target="#music_id' . $row['music_id'] . '" class="btn btn-sm btn-inverse-primary btn-fw"><i class="fa fa-pencil"></i></button></div>
                                                            <button class="btn btn-sm btn-inverse-danger btn-fw" data-placement="right" title="Delete Music" data-toggle="tooltip"  onclick="return showSwal(' . "'warning-message-and-cancel','../../Service/MusicService.php?serviceFlag=DELMUSIC&music_id=" . $row['music_id'] . "&csrf_token=" . $clib->get_csrf_token(true) . "'" . ')"><i class="fa fa-trash"></i></button>  
                                                        </div>';
                                    }
                                    echo '<!-- Modal Edit Uniform-->
    <div class="modal fade "  id="music_id' . $row['music_id'] . '" tabindex="-1" role="dialog"
         aria-labelledby="AddCutterModel" aria-hidden="true">
        <div class="modal-dialog mid-size modal-lg modal-dialog-centered " role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
               <div class="container-fluid">
                   <div class="row">
                       <div class="col-md-4 d-sm-flex align-items-end round-corners-center" style="background-image: url(../Common/assets/modal-x/img/musica.jpg)">
                          <div style="display:block;height:200px;"></div>
                       </div>
                      
                       <div class="col-md-8 py-5 px-sm-5 ">
                           <span class="inner-modal-title" style="text-align:left !important">Edit Music</span>
                             
                             <form class="cmxform" id="commentForm" method="post" enctype="multipart/form-data" action="../../Service/MusicService.php">
                                        <div class="form-row">
                                            <div class="form-group col-md-12 icon_input_container">
                                                <label for="name">Name</label>
                                                <input id="name" value="' . $row['name'] . '" type="text" name="name" class="form-control" required >
                                            </div><div class="form-group col-md-12 icon_input_container">
                                                <label for="genre">Genre</label>
                                                <select id="genre" name="genre" class="form-control" required>
                                                    <option value="' . $row['genre'] . '">' . $row['genre'] . '</option>
                                                    <option value="">-- Select --</option>
                                                    <option value="March">March</option>
                                                    <option value="Jazz">Jazz</option>
                                                    <option value="Test">Test</option>
                                                    <option value="Classical">Classical</option>
                                                    <option value="Light">Light</option>
                                                    <option value="Popular">Popular</option>
                                                    <option value="Other">Other</option>
                                                </select>                                                 
                                            </div><div class="form-group col-md-12 icon_input_container">
                                                <label for="composer">Composer</label>
                                                <input id="composer" value="' . $row['composer'] . '" type="text" name="composer" class="form-control" required >
                                            </div><div class="form-group col-md-12 icon_input_container">
                                                <label for="arranger">Arranger</label>
                                                <input id="arranger" value="' . $row['arranger'] . '" type="text" name="arranger" class="form-control" required >
                                            </div><div class="form-group col-md-12 icon_input_container">
                                                <label for="file_number">File Number</label>
                                                <input id="file_number" value="' . $row['file_number'] . '" type="text" name="file_number" class="form-control" required >
                                            </div><div class="form-group col-md-12 icon_input_container">
                                                <label for="music_file">Music File : <a href="../../Service/' . $row['music_file'] . '" target="blank">' . $row['file_number'] . '</a></label>                                                
                                                <input id="music_file" type="file" name="music_file" class="form-control" required >
                                            </div>
                                        </div>
                                        <input id="music_id" type="hidden" name="music_id" value="' . $row['music_id'] . '" />
                                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="serviceFlag" id="serviceFlag" value="EDITMUSIC">Edit Music</button>
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