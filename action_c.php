<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Open+Sans&family=Poppins&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <script src="https://kit.fontawesome.com/6b64f76ec9.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style2.css">
    <title>Garage Records </title>
</head>

<body>
    <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname  = "garage";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Error exists!" . $conn->connect_error);
    }

    $name = $email = $phone = $address = $carnumber = $vehicletype = $model = $fueltype = $company
        = $reg = $servicedate = $nextservice = $servicetype = $partsrep = $curkm = $nextkm = $tname = $aname
        = $workdetail = $labfee = $partsfee = $ibanno = $paymethod = $tpay = $comment = "";

    if (isset($_POST["submit"])) {

        $name = $_POST["name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $address = $_POST["address"];
        $carnumber = $_POST["car-number"];
        $vehicletype = $_POST["vehicle-type"];
        $model = $_POST["model"];
        $fueltype = $_POST["fuel-type"];
        $company = $_POST["company"];
        $reg = $_POST["reg"];
        $servicedate = $_POST["service-date"];
        $nextservice = $_POST["next-service"];
        $servicetype = $_POST["service-type"];
        $partsrep = $_POST["parts-rep"];
        $curkm = $_POST["cur-km"];
        $nextkm = $_POST["next-km"];
        $tname = $_POST["tname"];
        $aname = $_POST["aname"];
        $workdetail = $_POST["work-detail"];
        $labfee = $_POST["lab-fee"];
        $partsfee = $_POST["parts-fee"];
        $ibanno = $_POST["iban-no"];
        $paymethod = $_POST["pay-method"];
        $tpay = $_POST["tpay"];
        $comment = $_POST["comment"];


        $sql = "INSERT INTO `data` (`Owner Name`, `Email`, `Phone No`, `Address`, `Car Number`, `Vehicle Type`,
                                    `Model`,`Fuel Type`,`Company`,`Registration No`,`Service Date`,`Next Service Date`,
                                    `Service Type`,`Parts Replaced`,`Current Mileage`,`Next Service Mileage`,`Technician Name`,
                                    `Advisor Name`,`Work Details`,`Labour Fee`,`Parts Fee`,`Invoice No`,
                                    `Payment Method`,`Total Payment`,`Remarks`)
                            VALUES('$name','$email','$phone','$address','$carnumber','$vehicletype',
                                    '$model','$fueltype','$company','$reg','$servicedate','$nextservice',
                                    '$servicetype','$partsrep','$curkm','$nextkm','$tname',
                                    '$aname','$workdetail','$labfee','$partsfee','$ibanno',
                                    '$paymethod','$tpay','$comment')";

        if ($conn->query($sql) === true) {
            echo "";
        } else {
            die("Error!" . $conn->error);
        }
    }
    $search = "";
    if (isset($_POST["search-1"])) {
        $search = $_POST['search'] ?? '';
    }
    ?>
    <div class="navbar">
        <nav>
            <div class="logo">
                <img src="logo.png" alt="logo">
                <h1>Garage Records</h1>
            </div>
            <div class="forms">
                <form method="post">
                    <input type="text" name="search" placeholder="Owner Name or Car Number">
                    <input type="submit" value="Search" name="search-1">
                </form>
            </div>
            
        </nav>
    </div>

    <div class="box">

        <div class="tables">

            <?php
            if (!empty($search)) {
                $sql = "SELECT * FROM `data`
            WHERE `Owner Name` LIKE '%$search%'
            OR `Car Number` LIKE '%$search%'";

                $result = $conn->query($sql);

                echo "<table>
    <tr>
    <th>Owner Name</th>
    <th>Owner Phone</th>
    <th>Vehicle Type</th>
        <th>Car Number</th>
        <th>Car Model</th>
        <th>Service Type</th>
        <th>Service Date</th>
        <th>Current Mileage</th>
        <th>Labour Charges</th>
        <th>Total Payment</th>
    </tr>";

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
            <td>{$row['Owner Name']}</td>
            <td>{$row['Phone No']}</td>
            <td>{$row['Vehicle Type']}</td>
            <td>{$row['Car Number']}</td>
            <td>{$row['Model']}</td>
            <td>{$row['Service Type']}</td>
            <td>{$row['Service Date']}</td>
            <td>{$row['Current Mileage']}KM</td>
            <td>{$row['Labour Fee']}</td>
            <td>{$row['Total Payment']}</td>
            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='10'><h2>No Record Found...!</h2></td></tr>";
                }

                echo "</table>";
            }
            $conn->close();
            ?>
        </div>

    </div>


</body>

</html>