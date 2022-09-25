<!DOCTYPE html>
<html>

<head>
    <title>CricketFarm</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--link boostrap 4.0 online-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
    <!--link css-->
    <link rel="stylesheet" href="css/index.css">
</head>

<body class="container-fluid">
    <?php
    $dbservername = "localhost";
    $dbname = "cricketfarm";
    $dbusername = "root@";
    $dbpassword = "";

    //create connection to database
    $conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname, 3306);

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

            $row_DayOfAge = NULL;
            // tính số ngày kể từ khi nở tới hiện tại
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
                $row_DayOfAge = " ";
            }
                
            //Đổi định dạng Date cho dễ đọc
            if($row_Incubation_Day != NULL) {
                $row_Incubation_Day = date("d/m/Y", strtotime($row_Incubation_Day));
            }
            if($row_Hatching_Day != NULL) {
                $row_Hatching_Day = date("d/m/Y", strtotime($row_Hatching_Day));
            }



            echo    '<div class="col-lg-4 col-md-4 col-sm 12 col-12">
                        <div class="card">
                            <img class="card-img-top" src="imgs/Anh-de-men-full-HD.jpg" alt="cricket">
                            <div class="card-body">
                                <h4 class="card-title">CRICKET BARN ' . $row_Barn_Number .
                '   <form action="CricketFarm/ChangeBarnInfo.php" method="get" style="float:right;">
                                        <input type="text" name="pass" value="Lcn11031996" style="display:none;"></input>
                                        <input type="text" name="ID" value="' . $row_ID . '" style="display:none;"></input>
                                        <button class="btn btn-danger change-btn" type="submit">
                                            change
                                        </button>
                                    </form>
                                </h4>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><b>Mục đích: </b>' . $row_Purpose . '</li>
                                    <li class="list-group-item"><b>Ngày ấp: </b>' . $row_Incubation_Day . '</li>
                                    <li class="list-group-item"><b>Ngày nở: </b>' . $row_Hatching_Day . '</li>
                                    <li class="list-group-item"><b>Tiêu thụ cám: </b>' . $row_Bran_Consumed . 'kg</li>
                                    <li class="list-group-item"><b>Tiêu thụ rau: </b>' . $row_Vegetables_Consumed . 'kg</li>
                                    <li class="list-group-item"><h5 class="day-of-age"><b>' . $row_DayOfAge . '</b></h5></li>
                                </ul>
                            </div>
                        </div>
                    </div>';
        }
        echo '</div>';
        $result->free();
    }
    $conn->close();
    ?>
</body>

</html>