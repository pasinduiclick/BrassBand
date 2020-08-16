<form action="syslog.php" method="post">
    <input type="hidden" name="action" value="1"/>
    <input type="submit" value="Clear Log"/>
</form>

<table border="1">
    <tr>
        <th>Date</th>
        <th>User</th>
        <th>IP</th>
        <th>Details</th>
    </tr>

    <?php
    include './DatabaseConnection.php';
    $databaseConnection = new DatabaseConnection();
    $databaseConnection->openConnection();
    $query = "select * from log order by log_id desc";
    $result = $databaseConnection->openConnection()->query($query);
    while ($row = $result->fetch_assoc()) {
        echo '<tr>
        <td>'.$row['date_time'].'</td>
        <td>'.$row['username'].'</td>
        <td>'.$row['ipaddr'].'</td>
        <td>'.$row['description'].'</td>
    </tr>';    
    }
    
    $act = $_POST['action'];
    if($act=="1"){
        $databaseConnection->executeQuery("delete from log", "System Log Cleared");
    }
    ?>    
    
</table>