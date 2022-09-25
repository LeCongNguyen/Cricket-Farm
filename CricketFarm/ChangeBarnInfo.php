<!DOCTYPE html>
<html>

<head>
    <title>CricketFarm</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--link boostrap 4.0 online-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
    <!--link css-->
    <link rel="stylesheet" href="../css/index.css">
</head>

<body class="container-fluid">
    <?php
    $key = "Lcn11031996";
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $pass = $_GET["pass"];
        if ($pass == $key) {
            $barn_ID = $_GET["ID"];
        }
    }


    $dbservername = "localhost";
    $dbname = "cricketfarm";
    $dbusername = "root@";
    $dbpassword = "";

    //create connection to database
    $conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);

    //check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT ID, Barn_Number, Purpose, Incubation_Day, Hatching_Day, Bran_Consumed, Vegetables_Consumed 
    FROM DetailOfRoom_1 ORDER BY ID ASC";

    if ($result = $conn->query($sql)) {
        echo '<div class="row row-change">';
        while ($row = $result->fetch_assoc()) {
            $row_ID = $row["ID"];
            $row_Barn_Number = $row["Barn_Number"];
            $row_Purpose = $row["Purpose"];
            $row_Incubation_Day = $row["Incubation_Day"];
            $row_Hatching_Day = $row["Hatching_Day"];
            $row_Bran_Consumed = $row["Bran_Consumed"];
            $row_Vegetables_Consumed = $row["Vegetables_Consumed"];


            if ($row_ID == $barn_ID) {
                //tính số ngày kể từ khi nở tới hiện tại
                if ($row_Hatching_Day != NULL & $row_Incubation_Day != NULL) {
                    $first_date = strtotime($row_Hatching_Day);
                    $second_date = strtotime(date("y-m-d"));
                    $datediff = abs($first_date - $second_date);
                    $row_DayOfAge = ($datediff / (60 * 60 * 24)) . " ngày tuổi";
                }
                if ($row_Hatching_Day == NULL & $row_Incubation_Day != NULL) {
                    $row_DayOfAge = "Chưa nở";
                }
                if($row_Incubation_Day == NULL) {
                    $row_DayOfAge = "0";
                }


                echo    '<div class="col-lg-3 col-md-4 col-sm 12 col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title" style="display:flex; justify-content:space-between;">
                                        <p  id="barn-num" style="float:left;">BARN ' . $row_Barn_Number . '</p>
                                        <button id="reset-btn" class="btn btn-danger"  style="height:100%;"><b>reset</b></button>
                                    </h4>
                                    <form action="InsertToDatabase.php" method="GET">
                                        <ul class="list-group list-group-flush">
                                            <input style="display:none;" name="ID" value="' .$row_ID. '"></input>
                                            <li class="list-group-item">
                                                <b>Mục đích: </b> 
                                                <input id="purpose" class="form-control" name="purpose" value="' . $row_Purpose . '"></input>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Ngày ấp: </b>
                                                <input class="form-control" name="incubationDay" value="' . $row_Incubation_Day . '" type="date"></input>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Ngày nở: </b>
                                                <input class="form-control" name="hatchingDay" value="' . $row_Hatching_Day . '" type="date"></input>
                                            </li>
                                            <li class="list-group-item">
                                                <p><b>Tiêu thụ cám:  </b><p>
                                                <input class="form-control" name="branConsumed"value="' . $row_Bran_Consumed . '" type="number" step="0.1" min="0" style="width:50%;float:left;margin-right:1rem"></input>kg
                                            </li>
                                            <li class="list-group-item">
                                                <p><b>Tiêu thụ cám:  </b><p>
                                                <input class="form-control" name="vegetConsumed" value="' . $row_Vegetables_Consumed . '" type="number" step="0.1" min="0" style="width:50%;float:left;margin-right:1rem"></input>kg
                                            </li>
                                            <li class="list-group-item" style="display:flex; justify-content:space-between; margin-left:0;">
                                                <h5 class="day-of-age"><b>' . $row_DayOfAge . '</b></h5>
                                                <button id="save-btn" class="btn btn-primary" type="submit" name="pass" value="saveChange"><p><b>save</b></p></button> 
                                            </li>
                                        </ul>
                                    </form>
                                </div>
                            </div>
                        </div>';
                break;
            }
        }
        echo '</div>';
        $result->free();
    }
    $conn->close();
    ?>

    <script src="/js/resetSaveBtn.js"></script>
</body>

</html>