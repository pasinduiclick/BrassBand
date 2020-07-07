<?php

/**
 * Description of DatabaseConnection
 *
 * @author PASINDU SIRIWARDANA
 */
class DatabaseConnection {

    private $serverHost = "localhost";
    //DEVELOPMENT ENVIRONMENT
    private $databaseName = "brassband";
    private $userName = "root";
    private $password = "";
    private $timezone = 'Asia/Colombo';
    private $trackingEmail = ",pasindups@gmail.com";

    //PROD ENVIRONMENT
//    private $databaseName = "mrarachc_mrarachchi";
//    private $userName = "mrarachc_root";
//    private $password = "madura123";

    /*
     * connecting to the database using provided variables
     * If the connection is unsuccessfull passing error
     */

    function openConnection() {
        $conn = new mysqli($this->serverHost, $this->userName, $this->password, $this->databaseName);
        if ($conn->connect_error) {
            die("DB Connection failed : " . $conn->connect_error);
        }
        return $conn;
    }

    /*
     * passing parameter as a string and open the database connection, after that
     * executing the query.
     */

    function executeQuery($sqlQuery, $transactionDescription, $insrtid = false) {

        date_default_timezone_set($this->timezone);
        $username = "";
        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
        } else {
            //session_start();
        }
        $ipAddress = $_SERVER['REMOTE_ADDR'];
        $transDateTime = date(DATE_RFC822);
        $description = $transactionDescription . ' from pc ' . gethostname();
        $transSql = "insert into log values (0,'$username','$transDateTime','$ipAddress','$description')";

        $connection = $this->openConnection();
        if (!mysqli_query($connection, $sqlQuery)) {
            echo("Error description: " . mysqli_error($connection));
            $this->createExpFile(mysqli_error($connection));
            //die();
        } else {
            if ($insrtid) {
                return $connection->insert_id;
            }
            mysqli_query($connection, $transSql);
        }
        $this->closeConnection();
    }

    function addNotification($sale_id, $description) {
        $created = date(DATE_RFC822);
        $connection = $this->openConnection();
        $sqlQuery = "INSERT INTO notifications (description,status,created,sale_id) VALUES('$description','1','$created','$sale_id')";
        mysqli_query($connection, $sqlQuery);
        $this->closeConnection();
    }

    function getTransactionDate() {
        date_default_timezone_set($this->timezone);
        $username = "";
        //session_start();
        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
        }
        $ipAddress = " - " . $_SERVER['REMOTE_ADDR'] . ' from PC ' . gethostname();
        $created = " - " . date("Y-m-d H:i:s");

        return $username . $created . $ipAddress;
    }

    function getCommentCreated() {
        date_default_timezone_set($this->timezone);
        $username = "";
        //session_start();
        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
        }
        $created = " - " . date("Y-m-d H:i:s");

        return $username . " - " . $created;
    }

    function closeConnection() {
        mysqli_close($this->openConnection());
    }

    function createExpFile($expMessage) {
        $extFile = date('YmdHis') . '.txt';
        $newFile = fopen('Exception' . $extFile, "w") or die("Unable to open file!");
        fwrite($newFile, $expMessage);
        fclose($newFile);
        echo 'File created:' . $extFile . " EXP: " . $expMessage;
    }

    

    function sendInquiry($to) {

        $databaseConnection = new DatabaseConnection();
        $databaseConnection->openConnection();

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers = $headers . "Content-type:text/html;charset=UTF-8" . "\r\n";


        $message = "New inquiry from mobile app : ";
        $query = "SELECT * FROM inquiry where email='$to' and status!=0";
        $result = $databaseConnection->openConnection()->query($query);

        if ($row = $result->fetch_assoc()) {
            $message = $message . $row['name'] . " wants to have an inquiry about ".$row['service']."";
        }
        $to = $to . $databaseConnection->trackingEmail . "," . $_SESSION['email'];
        mail($to, "New customer inquiry", $message, $headers);

        $databaseConnection->executeQuery("update accounts set status=1 where acc_id=0 ", " Client Registration Link Email template " . $templateId . " sent to " . $to);
    }

   
//Generate sql queries and form tags-23042020-Pasindu
    function generateFieldsforColumns($tablename) {

        echo 'Table Name : ' . $tablename . '<br><br>';

        $database = new DatabaseConnection();
        $query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '$database->databaseName' AND TABLE_NAME = '$tablename'";
        $result = $database->openConnection()->query($query);
        $ColNamesArr = array();
        $ColNameValArr = array();
        while ($row = $result->fetch_assoc()) {
            echo "$" . $row['COLUMN_NAME'] . '=$clib->input("' . $row['COLUMN_NAME'] . '");' . '</br>';
            array_push($ColNamesArr, $row['COLUMN_NAME']);
            array_push($ColNameValArr, "$" . $row['COLUMN_NAME']);
        }


        echo "<br> Column(s) count : " . count($ColNamesArr) . '<br><br>';
        if (count($ColNamesArr) == 0) {
            die('<h3 style="color:red"> Table ' . $tablename . ' cannot be found in the database! </h3>');
        }

        $insertquery = "INSERT INTO $tablename (" . implode(",", $ColNamesArr) . ") VALUES('" . implode("','", $ColNameValArr) . "')";
        echo '<br>' . $insertquery . '</br>';



        $updateStr = "UPDATE " . $tablename . " SET ";
        for ($index = 1; $index < count($ColNamesArr); $index++) {
            $updateStr = $updateStr . $ColNamesArr[$index] . "='" . $ColNameValArr[$index] . "',";
        }
        $updateStr = $updateStr . " WHERE " . $ColNamesArr[0] . "='" . $ColNameValArr[0] . "'";
        echo '<br>' . $updateStr;

        echo '<br>==============================================================================================<br>';

        $query1 = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '$database->databaseName' AND TABLE_NAME = '$tablename'";
        $result1 = $database->openConnection()->query($query1);
        while ($row1 = $result1->fetch_assoc()) { {
                echo '<div class="form-group">
                    <label for="' . $row1['COLUMN_NAME'] . '">' . ucfirst($row1['COLUMN_NAME']) . '</label>
                    <input id="' . $row1['COLUMN_NAME'] . '" value="' . $row1['COLUMN_NAME'] . '" type="text" name="' . $row1['COLUMN_NAME'] . '" class="form-control" required >
        </div>';
            }
        }
    }

}

?>