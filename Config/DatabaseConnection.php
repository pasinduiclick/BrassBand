<?php

/**
 * Description of DatabaseConnection
 *
 * @author PASINDU SIRIWARDANA
 */
include 'SMTPEmailConfig.php';
class DatabaseConnection {

    private $serverHost = "localhost";
    private $timezone = 'Pacific/Auckland';
    
    //DEVELOPMENT ENVIRONMENT
    private $databaseName = "brassband";
    private $userName = "root";
    private $password = "";
    

    //PROD ENVIRONMENT
//    private $databaseName = "iclick_brassband";
//    private $userName = "iclick_brass";
//    private $password = "brass@123";

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

    function openSMPTP() {
        $query = "SELECT * from emailconfig";
        $result =  $this->openConnection()->query($query);
        while ($row = $result->fetch_assoc()) {
            $_SESSION['portnum'] = $row['portnum'];
            $_SESSION['host'] = $row['host'];
            $_SESSION['smtpusername'] = $row['username'];
            $_SESSION['smtppasswrd'] = $row['passwrd'];
        }
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
        $this->openSMPTP();
        
        if (!mysqli_query($connection, $sqlQuery)) {
            $this->writeErrorLog(mysqli_error($connection));
            echo("Error description: " . mysqli_error($connection));
            $this->createExpFile(mysqli_error($connection));
            die();
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

    function sendEmailNotification($ref_number,$mem_id,$return_date) {

        $databaseConnection = new DatabaseConnection();
        $databaseConnection->openConnection();
        $MailHelper = new SMTPEmailConfig();

        $helloName = ""; //(Inside the email template);
        $required_date = $return_date; //(Inside the email template);        
        $to = "";
        
        $querya = "select name,email from membership WHERE mem_id='$mem_id'";
        $resulta = $databaseConnection->openConnection()->query($querya);
        if ($rowa = $resulta->fetch_assoc()) {
            $helloName = $rowa['name'];
            $to = $rowa['email'];
        }

        $message = "Hello $helloName, You have rented items from Marlborough Brass Band. Ref Number : $ref_number";

        if ($MailHelper->openSMTP($to, $subject, $message) == 1) {
            $databaseConnection->executeQuery("update membership set status=1 where mem_id=0", $ref_number . " notification email sent to " . $to);
        } else {
            $databaseConnection->executeQuery("update membership set status=1 where mem_id=0", "Email sent Failed from sendEmailNotification() " . $ref_number);
        }
    }

}

?>