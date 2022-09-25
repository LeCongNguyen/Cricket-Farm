<?php
$dbservername = "localhost";
$dbname = "cricketfarm";
$dbusername = "root@";
$dbpassword = "";

$key = "Lcn11031996";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["pass"] == $key) {
        $barnID = $_POST["barnID"];
        echo $barnID;
    }

    //create connection to database
    $conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);

    //check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE DetailOfRoom_1 SET Purpose='', Incubation_Day=NULL, Hatching_Day=NULL,
Bran_Consumed=NULL, Vegetables_Consumed=NULL WHERE ID=" . $barnID;

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if ($_GET["pass"] == "saveChange") {
        $barnID = $_GET["ID"];
        $purpose = $_GET["purpose"];
        $incubDay = $_GET["incubationDay"];
        $hatchDay = $_GET["hatchingDay"];
        $bran = $_GET["branConsumed"];
        $veget = $_GET["vegetConsumed"];
    }

    //create connection to database
    $conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);

    //check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE DetailOfRoom_1 SET Purpose='$purpose', Incubation_Day='$incubDay', 
    Hatching_Day='$hatchDay', Bran_Consumed='$bran', Vegetables_Consumed='$veget' WHERE ID=$barnID";

    if ($conn->query($sql) === TRUE) {
        echo "The change updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>
