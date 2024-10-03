<?php
session_start(); 

if (!isset($_SESSION['username'])) {
    header('Location: adminlog.php');
    exit();
}
include 'insert.php';  

$message = ""; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_name = $_POST['customer_name'];
    $new_status = $_POST['status'];

    if (isset($customer_name) && isset($new_status)) {
        $update_sql = "UPDATE booking SET status = ? WHERE customer_name = ?";
        $stmt = $conn->prepare($update_sql);
        if ($stmt) {
            $stmt->bind_param('ss', $new_status, $customer_name);
            if ($stmt->execute()) {
                $message = "<div class='alert alert-success'>Status updated successfully.</div>";
            } else {
                $message = "<div class='alert alert-danger'>Error updating status: " . $stmt->error . "</div>";
            }
            $stmt->close();
        } else {
            $message = "<div class='alert alert-danger'>Error preparing statement: " . $conn->error . "</div>";
        }
    } else {
        $message = "<div class='alert alert-warning'>Invalid customer name or status.</div>";
    }
}

$sql = "SELECT customer_name, booking_date, booking_time, package_name, status FROM booking";
$result = $conn->query($sql);

if (!$result) {
    die("Error executing query: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title>Booking Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #2c3e50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #eaeaea;
        }

        .back-home {
            text-decoration: none;
            font-size: 18px;
            color: #007BFF;
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .back-home:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        .back-home svg {
            margin-right: 8px;
            fill: currentColor;
        }

        table th:last-child,
        table td:last-child {
            text-align: center;
        }

        form {
            display: inline-block;
        }

        td select {
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
            font-size: 14px;
            color: #333;
            transition: all 0.3s ease;
            width: 100%; /* Full width */
            background-color: #ffffff; /* White background */
        }

        td select option {
            background-color: white; 
        }

        td select option[value="Pending"] {
            background-color: #ffcccb; 
            color: black; 
        }

        td select option[value="Approved"] {
            background-color: #add8e6; 
            color: black; 
        }

        td select option[value="Rejected"] {
            background-color: #90ee90; 
            color: black;
        }

        td select:hover {
            border-color: #007BFF; 
        }

        td select:focus {
            outline: none;
            border-color: #007BFF; 
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); 
        }

        td button {
            margin-left: 10px;
            padding: 8px 12px; 
            border: none;
            border-radius: 4px;
            background-color: #007BFF; 
            color: white;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease; 
        }

        td button:hover {
            background-color: #0056b3; 
        }

        .alert {
            margin: 10px auto;
            width: 80%;
            padding: 10px;
            border-radius: 4px;
            text-align: center;
        }

        .alert-success {
            background-color: #dff0d8;
            color: #3c763d;
        }

        .alert-danger {
            background-color: #f2dede;
            color: #a94442;
        }

        .alert-warning {
            background-color: #fcf8e3;
            color: #8a6d3b;
        }
    </style>

</head>

<body>
    <a href="admin.php" class="back-home">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 0 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 7.5H14.5A.5.5 0 0 1 15 8z" />
        </svg> Back to Home
    </a>

    <?php echo $message; ?>

    <h1>Booking Data</h1>
    <table>
        <thead>
            <tr>
                <th>Customer Name</th>
                <th>Booking Date</th>
                <th>Booking Time</th>
                <th>Package Name</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["customer_name"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["booking_date"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["booking_time"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["package_name"]) . "</td>";
                    echo "<td>";

                    echo "<form method='post' action=''>"; 
                    echo "<input type='hidden' name='customer_name' value='" . htmlspecialchars($row["customer_name"]) . "'>";
                    echo "<select name='status'>";
                    echo "<option value='Pending'" . ($row['status'] == 'Pending' ? ' selected' : '') . ">Pending</option>";
                    echo "<option value='Approved'" . ($row['status'] == 'Approved' ? ' selected' : '') . ">Approved</option>";
                    echo "<option value='Rejected'" . ($row['status'] == 'Rejected' ? ' selected' : '') . ">Rejected</option>";
                    echo "</select>";
                    echo "<button type='submit' class='btn btn-success btn-sm'>Update</button>";
                    echo "</form>";

                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No bookings found</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var selects = document.querySelectorAll('select');

        selects.forEach(function (select) {
            select.addEventListener('change', function () {
                var selectedValue = select.value;
                var customerName = select.previousElementSibling.value;
            });
        });
    });
</script>
</html>
