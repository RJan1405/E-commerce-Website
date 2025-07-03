
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" href="../../../css/topnav.css">
    <link rel="stylesheet" href="../../../css/fstyle.css">
    <script type="text/javascript">
        function Status(id) {
            if (confirm("Car?")) {
                window.location.href = '../../../booking_status/checkstatus/check_status.php?id=' + id;
            }
        }
    </script>
    <style>
        body {
            background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.2)), url("../../../../pictures/img30.jpg");
            background-color: #cccccc;
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            position: initial;
            background-attachment: fixed;
        }
        img {
            margin-top: 20%;
            width: 100%;
            height: 50%;
        }
        /* Add styles to the form container */
        .container {
            position: absolute;
            left: 65%;
            top: 5%;
            margin: 20px;
            max-width: 300px;
            padding: 16px;
            background-color: none;
        }
        .booked {
            color: red; /* Color for booked time slots */
        }
        .available {
            color: green; /* Color for available time slots */
        }
    </style>
</head>

<body>

<div class="topnav">
    <a href="../../../index.html">Home</a>
    <a href="../../../search/search.php">Search</a>
    <a class="active" href="../../../checkstatus/check_status.php">Status</a>
    <a href="../../../../INDEX.html">Log Out</a>
</div>

<?php
include '../../../../includes/config.php';
$car_id = $_REQUEST['id'];
$date = date('Y-m-d'); // Initialize date variable for current date
if (isset($_POST['bookdate'])) {
    $date = $_POST['bookdate']; // Get the date from the form
}

$sel = "SELECT * FROM CAR WHERE Car_id = '$car_id'";
$rs = $conn->query($sel);
$rws = $rs->fetch_assoc();

// Fetch already booked slots for the specified date
$bookedSlotsQuery = "SELECT Start_time FROM TEST_SLOT WHERE Car_id = '$car_id' AND Book_date = '$date'";
$bookedSlotsResult = $conn->query($bookedSlotsQuery);
$bookedSlots = [];

while ($row = $bookedSlotsResult->fetch_assoc()) {
    $bookedSlots[] = $row['Start_time'];
}
?>

<form method="post" class="container">
    <h1 style="color: #d6dbdf;">Book Your Slot!!</h1>
    <label style="color: #d6dbdf;" for="userid"><b>Email</b></label>
    <input type="email" placeholder="Enter your email" name="userid" required>

    <label style="color: #d6dbdf;" for="bookdate"><b>Date of Booking</b></label>
    <input type="date" placeholder="Enter the Date of Booking" name="bookdate" required value="<?= $date ?>">

    <label style="color: #d6dbdf;" for="time"><b>Time Slot</b></label>
    <select name="time">
        <?php
        $timeOptions = ["10:00", "11:00", "12:00", "13:00", "14:00", "15:00", "16:00", "17:00", "18:00", "19:00", "20:00"];
        foreach ($timeOptions as $time) {
            if (in_array($time, $bookedSlots)) {
                echo "<option class='booked' value='$time' disabled>$time (Booked)</option>"; // Time is booked
            } else {
                echo "<option class='available' value='$time'>$time (Available)</option>"; // Time is available
            }
        }
        ?>
    </select>

    <label style="color: #d6dbdf;" for="location"><b>Location</b></label>
    <input type="text" placeholder="Enter the location" name="location" required>

    <button name="book" class="btn">Book</button>
</form>

<?php
if (isset($_POST['book'])) {
    include '../../../../includes/config.php';
    $userid = $_POST['userid'];
    $bookdate = $_POST['bookdate'];
    $time = $_POST['time']; // Getting the selected time slot
    $location = $_POST['location'];

    $qr1 = "INSERT INTO TEST_SLOT (Car_id, Book_date, Start_time, U_login_id) 
    VALUES ('$car_id', '$bookdate', '$time', '$userid')";
    $result1 = $conn->query($qr1);

    if ($result1 === TRUE) {
        $qr2 = "SELECT * FROM TEST_SLOT WHERE Car_id = '$car_id' AND U_login_id='$userid' AND Book_date = '$bookdate'";
        $result2 = $conn->query($qr2);
        if ($result2 === TRUE) {
            $rows = $result2->fetch_assoc();
            $slot_id = $rows['Slot_id'];
            $qr3 = "INSERT INTO SLOT_LOCATION VALUES('$slot_id', '$location')";
            $result3 = $conn->query($qr3);
            if ($result3 === TRUE) {
                echo "<script type='text/javascript'>
                    alert('Booking successful. Please get your Driving licence');
                    window.location=('../../../checkstatus/check_status.php');
                </script>";
            } else {
                echo "<script type='text/javascript'>
                    alert('Booking Failed. Try Again');
                    window.location=('../../search.php');
                </script>";
            }
        }
    }
}
?>

</body>
</html>