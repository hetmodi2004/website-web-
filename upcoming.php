<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <title>Manage Upcoming Events</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f0f4f8;
        }
        
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        
        h1 {
            text-align: center;
            color: #1abc9c;
            margin-bottom: 20px;
        }
        
        .form-group label {
            font-weight: bold;
        }
        
        .btn-primary {
            background-color: #1abc9c;
            border-color: #16a085;
        }
        
        .btn-primary:hover {
            background-color: #16a085;
            border-color: #149174;
        }
        
        table {
            margin-top: 30px;
            width: 100%;
        }
        
        th,
        td {
            text-align: left;
            padding: 10px;
        }
        
        th {
            background-color: #2c3e50;
            color: white;
        }
        
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        
        tr:hover {
            background-color: #d9d9d9;
        }
        
        .alert {
            margin-top: 20px;
        }
        .back-home {
            text-decoration: none;
            font-size: 18px;
            color: #333;
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .back-home:hover {
            color: #007BFF;
        }
        
        .back-home svg {
            margin-right: 8px;
            fill: currentColor;
        }
    </style>
</head>

<body>
    <div class="container">
        <a href="admin.php" class="back-home">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 0 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 7.5H14.5A.5.5 0 0 1 15 8z"/>
    </svg> Back to Home
        </a>
        <h1>Add Upcoming Event</h1>
        <form action="#" method="POST">
            <div class="form-group">
                <label for="eventTitle">Event Title:</label>
                <input type="text" class="form-control" id="eventTitle" name="eventTitle" required>
            </div>
            <div class="form-group">
                <label for="eventDate">Event Date:</label>
                <input type="date" class="form-control" id="eventDate" name="eventDate" required>
            </div>
            <div class="form-group">
                <label for="eventDescription">Event Description:</label>
                <textarea class="form-control" id="eventDescription" name="eventDescription" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Event</button>
        </form>
    </div>

    <div class="container">
        <h1>Upcoming Events</h1>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Event Title</th>
                    <th>Event Date</th>
                    <th>Description</th>
                </tr>
                <p>price will be declared soon</P>
            </thead>
            <tbody>
                <?php
                session_start(); 

                if (!isset($_SESSION['username'])) {
                    header('Location: adminlog.php');
                    exit();
                }
                
                include 'insert.php'; 

                $successMessage = '';

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $title = htmlspecialchars($_POST['eventTitle']);
                    $event_date = htmlspecialchars($_POST['eventDate']);
                    $description = htmlspecialchars($_POST['eventDescription']);

                    $sql = "INSERT INTO event (title, event_date, description) VALUES ('$title', '$event_date', '$description')";
                    
                    if ($conn->query($sql) === TRUE) {
                        $successMessage = "New event added successfully!";
                    } else {
                        $successMessage = "Error: " . $sql . "<br>" . $conn->error;
                    }
                }

                $sql = "SELECT title, event_date, description FROM event";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($row['title']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['event_date']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['description']) . '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="3">No upcoming events available.</td></tr>';
                }

                $conn->close();
                ?>
            </tbody>
        </table>

        <?php if ($successMessage): ?>
        <div class="alert alert-success">
            <?php echo $successMessage; ?>
        </div>
        <?php endif; ?>
    </div>
</body>

</html>