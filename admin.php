<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: adminlog.php");
    exit();
}
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Georgia:wght@700&display=swap" rel="stylesheet">
        <title>Admin Dashboard</title>
        <style>
            body {
                margin: 0;
                font-family: 'Roboto', sans-serif;
                background-color: #f0f4f8;
                display: flex;
            }
            
            .sidebar {
                width: 260px;
                height: 100vh;
                position: fixed;
                top: 0;
                left: 0;
                background: linear-gradient(180deg, #2c3e50 0%, #34495e 100%);
                color: white;
                display: flex;
                flex-direction: column;
                padding-top: 20px;
                box-shadow: 2px 0 10px rgba(0, 0, 0, 0.5);
                transition: width 0.3s;
            }
            
            .sidebar h2 {
                text-align: center;
                margin-bottom: 30px;
                font-size: 28px;
                font-weight: 700;
                font-family: 'Georgia', serif;
                color: #ecf0f1;
            }
            
            .sidebar a {
                padding: 15px;
                text-decoration: none;
                font-size: 18px;
                color: #ecf0f1;
                display: block;
                text-align: center;
                border-radius: 5px;
                transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s;
            }
            
            .sidebar a:hover {
                background-color: #1abc9c;
                transform: scale(1.05);
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            }
            
            .sidebar .logout-btn {
                margin-top: auto;
                padding: 15px;
                background-color: #e74c3c;
                text-align: center;
                cursor: pointer;
                border-radius: 5px;
                transition: background-color 0.3s, transform 0.3s;
            }
            
            .sidebar .logout-btn:hover {
                background-color: #c0392b;
                transform: scale(1.05);
            }
            
            .main-content {
                margin-left: 260px;
                padding: 20px;
                width: 100%;
                box-sizing: border-box;
                position: relative;
            }
            
            .main-content h1 {
                font-size: 30px;
                margin-bottom: 20px;
                color: #1abc9c;
                text-align: center;
                text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
            }
            
            .dashboard-container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 20px;
                text-align: center;
            }
            
            .admin-dashboard {
                display: flex;
                justify-content: space-around;
                align-items: flex-start;
                flex-wrap: wrap;
                margin-top: 30px;
            }
            
            .box {
                background-color: #ffffff;
                border-radius: 12px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
                padding: 25px;
                width: 240px;
                text-align: center;
                transition: transform 0.3s, box-shadow 0.3s;
                margin: 30px;
                position: relative;
            }
            
            .box::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: linear-gradient(180deg, rgba(26, 188, 156, 0.1), rgba(255, 255, 255, 0));
                border-radius: 12px;
                z-index: 0;
            }
            
            .box h2 {
                margin: 0px;
                font-size: 22px;
                color: #34495e;
                z-index: 1;
            }
            
            .event-count,
            .user {
                font-size: 44px;
                color: #1abc9c;
                font-weight: bold;
                z-index: 1;
            }
            
            .empty-container {
                margin-top: 20px;
            }
            .box {
                background-color: #ffffff;
                border-radius: 12px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
                padding: 25px;
                width: 240px;
                text-align: center;
                transition: transform 0.3s, box-shadow 0.3s;
                margin: 30px;
                position: relative;
            }
            
            .box:hover {
                transform: translateY(-5px);
                box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
                background-color: #f9f9f9;
                transition: transform 0.3s, box-shadow 0.3s, background-color 0.3s;
            }
            
            .header {
                width: 100%;
                padding: 15px;
                display: flex;
                justify-content: flex-end;
                position: fixed;
                top: 0;
                right: 0;
                z-index: 999;
            }
            
            .username {
                font-size:20px;
                color: #34495e;
                margin-right: 730px;
            }
            .profile-btn {
            padding: 10px 20px;
            background-color: black;
            color: white;
            text-decoration: none;
            border-radius: 20px;
            font-size: 18px;
            margin-left: 10px;
            transition: background-color 0.3s, transform 0.3s;
        }

        .profile-btn:hover {
            background-color: green;
            color:white;
            transform: scale(1.05);
        }
        </style>
    </head>

    <body>
        <div class="sidebar">
            <h2 style="color:white;">HM DECORATION</h2>
            <a href="./list.php">Package List</a>
            <a href="./user.php">Registered Users</a>
            <a href="./customer.php">Booking Detail</a>
            <a href="./upcoming.php">Upcoming Events</a>
            <a href="./adminout.php" class="logout-btn">Logout</a>
        </div>
        <div class="main-content">
            <div class="header">
               <b><p class="username">Welcome, <strong><?php echo $_SESSION['username']; ?></strong> ! </p></b>
                <a href="./profile.php" class="profile-btn">Admin Profile</a>
            </div>
            <div class="dashboard-container">
                <u><h2>ADMIN DASHBOARD</h2></u>
                <div class="admin-dashboard">
                    <div class="box empty-container">
                        <h2>TOTAL EVENTS</h2>
                        <p class="event-count">
                            <?php 
                        include 'insert.php';
                        $sql = "SELECT COUNT(*) AS total_packages FROM package"; 
                        $result = $conn->query($sql);
                        $total_packages = $result->num_rows > 0 ? $result->fetch_assoc()['total_packages'] : 0;
                        echo $total_packages;
                        ?>
                        </p>
                    </div>

                    <div class="box user">
                        <h2>TOTAL USERS</h2>
                        <p>
                            <?php 
                        $sql = "SELECT COUNT(*) AS total_users FROM user";
                        $result = $conn->query($sql);
                        $total_users = $result->num_rows > 0 ? $result->fetch_assoc()['total_users'] : 0;
                        echo $total_users;
                        $conn->close();
                        ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                // Alert on clicking the logout button
                $('.logout-btn').click(function() {
                    alert('You are logging out!');
                });
            });
        </script>
    </body>

    </html>