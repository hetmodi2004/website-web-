<?php
session_start(); 

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

include 'insert.php';

$package_name = isset($_GET['package_name']) ? urldecode($_GET['package_name']) : '';

$message = ''; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_name = $_POST['customer_name'];
    $customer_email = $_POST['customer_email'];
    $booking_date = $_POST['booking_date'];
    $booking_time = $_POST['booking_time'];
    $package_name = $_POST['package_name'];

    $stmt = $conn->prepare("INSERT INTO booking (customer_name, customer_email, booking_date, booking_time, package_name) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $customer_name, $customer_email, $booking_date, $booking_time, $package_name);

    if ($stmt->execute()) {
        $message = "<script>
                        alert('Booking successful!');
                        setTimeout(function() {
                            window.location.href = 'index1.php';
                        }, 1000); 
                    </script>";
    } else {
        $message = "<p style='color: red;'>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    <title>Booking Form</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .form-container { 
            max-width: 600px; 
            margin: auto; 
            padding: 20px; 
            border: 1px solid #ddd; 
            border-radius: 8px; 
            background-color: #f9f9f9; 
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .form-container label { display: block; margin: 10px 0 5px; }
        .form-container input { padding: 10px; margin-bottom: 10px; width: 100%; border-radius: 4px; border: 1px solid #ccc; }
        .form-container button { padding: 10px 15px; background-color: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer; }
        .error { color: red; font-size: 14px; }
        .back-home {
    text-decoration: none;
    font-size: 18px;
    color: #3498db;
    display: inline-flex;
    align-items: center;
    margin-bottom: 20px;
}

.back-home:hover {
    color: #2980b9;
}

.back-home svg {
    margin-right: 8px;
    fill: currentColor;
}
    </style>
</head>
<body ng-app="bookingApp" ng-controller="BookingController">

<div class="form-container">
<a href="package.php" class="back-home">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 0 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 7.5H14.5A.5.5 0 0 1 15 8z"/>
    </svg>
    Back to package  
</a>
    <h2>BOOK PACKAGE</h2>
    
    <?php if (isset($message)) echo $message; ?>
    
    <form name="bookingForm" method="POST" action="" novalidate>
        <label for="package_name">Selected Package:</label>
        <input type="text" id="package_name" name="package_name" value="<?php echo htmlspecialchars($package_name); ?>" readonly>

        <label for="customer_name">Your Name:</label>
        <input type="text" id="customer_name" name="customer_name" ng-model="formData.customer_name" required>
        <span class="error" ng-show="bookingForm.customer_name.$touched && bookingForm.customer_name.$invalid">Name is required.</span>

        <label for="customer_email">Your Email:</label>
        <input type="email" id="customer_email" name="customer_email" ng-model="formData.customer_email" required>
        <span class="error" ng-show="bookingForm.customer_email.$touched && bookingForm.customer_email.$invalid">Valid email is required.</span>

        <label for="booking_date">Booking Date:</label>
        <input type="date" id="booking_date" name="booking_date" ng-model="formData.booking_date" required>
        <span class="error" ng-show="bookingForm.booking_date.$touched && bookingForm.booking_date.$invalid">Date is required.</span>

        <label for="booking_time">Booking Time:</label>
        <input type="time" id="booking_time" name="booking_time" ng-model="formData.booking_time" required>
        <span class="error" ng-show="bookingForm.booking_time.$touched && bookingForm.booking_time.$invalid">Time is required.</span>

        <button type="submit" ng-disabled="bookingForm.$invalid">Book Now</button>
    </form>
</div>

<script>
    var app = angular.module('bookingApp', []);

    app.controller('BookingController', function($scope) {
        $scope.formData = {};
    });
</script>

</body>
</html>
