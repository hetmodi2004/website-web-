<?php
// Include your database connection file
include 'insert.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $email = trim($_POST['email']);
    $errors = [];

    // Validation
    if (empty($username)) {
        $errors[] = "Username is required.";
    }

    if (empty($password)) {
        $errors[] = "Password is required.";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters long.";
    }

    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }

    if (empty($errors)) {
        // Insert into the database
        $sql = "INSERT INTO user (username, password, email) VALUES ('$username', '$password', '$email')";

        if ($conn->query($sql) === TRUE) {
            // Redirect to login page
            header('Location: login.php');
            exit(); // Always call exit after a header redirect
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // Display errors if any
        foreach ($errors as $error) {
            echo "<div class='error-message'>$error</div>";
        }
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
         body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background-color: white;
            padding: 40px;
            border-radius: 12px;
            width: 400px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .form-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3);
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        .form-group label {
            font-size: 16px;
            font-weight: 500;
            color: #555;
            text-align: left;
            display: block;
            margin-bottom: 8px;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            margin-bottom: 5px;
            border: 1px solid #ddd;
            border-radius: 25px;
            font-size: 16px;
            box-sizing: border-box;
            background-color: #f9f9f9;
            transition: background-color 0.3s, border-color 0.3s;
        }

        .form-group input:focus {
            background-color: #fff;
            border-color: #007bff;
            outline: none;
        }

        .form-group input:hover {
            background-color: #f1f1f1;
        }

        button[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 14px;
            width: 100%;
            border-radius: 25px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
            transform: translateY(-3px);
        }

        a {
            display: block;
            margin-top: 20px;
            font-size: 14px;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
        }

        .password-container {
            position: relative;
        }

        .eye-icon {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            cursor: pointer;
            color: #007bff;
            font-size: 18px;
            transition: color 0.3s;
        }

        .eye-icon:hover {
            color: #0056b3;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Registration Form</h2><br>
        <form id="registrationForm" action="" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username">
                <span class="error-message" id="usernameError"></span>
            </div>

            <div class="form-group password-container">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password">
                <span class="eye-icon" id="togglePassword">
                    <i class="fas fa-eye"></i>
                </span>
                <span class="error-message" id="passwordError"></span>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email">
                <span class="error-message" id="emailError"></span>
            </div>

            <button type="submit">Register</button>
            <a href="./login.php">Already have an account? Login here</a>
        </form>
    </div>
    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        togglePassword.addEventListener('click', () => {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            togglePassword.querySelector('i').classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>
