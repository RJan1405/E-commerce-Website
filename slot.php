<?php
include('functions/userfunctions.php');
include('includes/header.php');
$product = $_GET['product_ID'];
$query = "SELECT * from products WHERE id='$product'";
$query_run = mysqli_query($conn, $query);
$item = mysqli_fetch_array($query_run);
// Initialize variables
$booking_date = date('Y-m-d'); // Default to today's date
$booked_times = [];
// Fetch booked slots for the selected date
if (isset($_POST['booking_date'])) {
    $booking_date = $_POST['booking_date'];
}

$result = $conn->query("SELECT booking_time FROM bookings WHERE booking_date = '$booking_date'");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $booked_times[] = $row['booking_time'];
    }
}
// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['booking_time'])) {
    $booking_time = $_POST['booking_time'];
    $prod_id=$_POST['prod_id'];
    $prod_name=$_POST['prod_name'];
    $name=$_POST['name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $address=$_POST['address'];
    $pincode=$_POST['pincode'];
    $user_id = $_SESSION['auth_user']['user_id'];
    $tracking_no = "TestDrive" . rand(1111, 9999) . substr($phone, 2);
    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO bookings (user_id,tracking_no,prod_id,prod_name,booking_date, booking_time,name,email,phone_no,address,pincode) 
    VALUES ('$user_id','$tracking_no','$prod_id','$prod_name',?, ?,'$name','$email','$phone','$address','$pincode')");
    $stmt->bind_param("ss", $booking_date, $booking_time);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        header('Location: my-TestDrive.php');   
    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
    }
    // Close the statement
    $stmt->close();
}

?>
<div class="py-3 bg-primary">
    <div class="container">
        <h6 class="text-white">
            <a class="text-white" style="text-decoration: none;" href="index.php">
                Home /
            </a>
            <a class="text-white" style="text-decoration: none;" href="categories.php">
                Collections /
            </a>
            <?= $item['name']; ?> /
            Book a Test Drive
        </h6>
    </div>
</div>
<br><br>
<div class="container">
    <div class="card">
        <div class="card-body shadow">
            <form id="bookingForm" action="" method="POST">
                <div class="row justify-content-center">
                    <div class="col-md-5">
                        <h5>Basic Details</h5>
                        <hr>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold ">Name</label>
                                <input type="text" name="name" required placeholder="Enter your full name" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold ">E-mail</label>
                                <input type="email" name="email" required placeholder="Enter your email" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold ">Phone</label>
                                <input type="phone" name="phone" required placeholder="Enter your phone number" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold ">Pin code</label>
                                <input type="text" name="pincode" required placeholder="Enter your pin code" class="form-control">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="fw-bold ">Address</label>
                                <textarea name="address" required class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <h5>Booking Details</h5>
                        <hr>
                        
                            <div class="col-md-12 mb-4 fw-bold">
                                <label for="booking_date">Booking Date</label><br>
                                <input type="date" id="booking_date" name="booking_date" value="<?php echo $booking_date; ?>" required>
                            </div>
                            <div class="col-md-12 mb-4 fw-bold">
                                <label for="booking_time">Select Booking Time</label><br>
                                <select id="booking_time" name="booking_time" required>
                                    <?php
                                    // Function to generate time slots (from 8 AM to 5 PM)
                                    function generateTimes($booked_times)
                                    {
                                        $options = '';
                                        $start_time = new DateTime('08:00:00');
                                        $end_time = new DateTime('17:00:00');
                                        $time_interval = new DateInterval('PT1H');

                                        while ($start_time <= $end_time) {
                                            $time = $start_time->format('H:i:s');
                                            if (in_array($time, $booked_times)) {
                                                // Display booked time as a disabled option with red color
                                                $options .= "<option value='$time' class='booked' disabled>$time (Booked)</option>";
                                            } else {
                                                // Display available time with green color
                                                $options .= "<option value='$time' class='available'>$time</option>";
                                            }
                                            $start_time->add($time_interval);
                                        }
                                        return $options;
                                    }
                                    // Output the current date's slots
                                    echo generateTimes($booked_times);
                                    ?>
                                </select>
                            </div>
                    </div>
                    <div class="col-md-4">
                        <h5>Order Details</h5>
                        <hr>
                        <div class="row align-items-center">
                            <div class="col-md-5">
                                <h6>Product</h6>
                            </div>
                            <div class="col-md-3">
                                <h6>Name</h6>
                            </div>
                        </div>
                        <div class="card product_data shadow-sm mb-3">
                            <div class="row align-items-center">
                                <div class="col-md-5">
                                    <img src="uploads/<?= $item['image'] ?>" alt="Image" class="w-500" width="80px" height="80px">
                                </div>
                                <div class="col-md-3">
                                    <input type="hidden" name="prod_id" value="<?= $item['id'] ?>">
                                    <input type="hidden" name="prod_name" value="<?= $item['name'] ?>">
                                    <h5><?= $item['name'] ?></h5>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="">
                            <input type="hidden" name="payment_mode" value="COD">
                            <button type="submit" name="Book" value="Book" class="btn btn-primary w-100">Pay and Conform your order</button>
                        </div>


                    </div>
                </div>
            </form>
            <script>
                // Attach event listener to the date input
                document.getElementById('booking_date').addEventListener('change', function() {
                    var selectedDate = this.value;

                    // Create a form data object and append the selected date to it
                    var formData = new FormData();
                    formData.append('booking_date', selectedDate);

                    // Send an AJAX request to the same PHP file
                    fetch(window.location.href, {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.text())
                        .then(data => {
                            // Update the booking_time select with the new options
                            var parser = new DOMParser();
                            var doc = parser.parseFromString(data, 'text/html');
                            var newOptions = doc.querySelector('#booking_time').innerHTML;
                            document.getElementById('booking_time').innerHTML = newOptions;
                        });
                });
            </script>
        </div>
    </div>
</div>