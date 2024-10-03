<?php
session_start();

require 'insert.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['username'] = $username;
        header('Location: index1.php');
        exit();
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
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
        margin-bottom: 15px;
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

    .error {
        color: red;
        font-size: 14px;
        text-align: left;
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
        right: 10px;
        transform: translateY(-50%);
        cursor: pointer;
        color: #007bff; 
        font-size: 18px; 
        transition: color 0.3s; 
    }

    .eye-icon:hover {
        color: #0056b3; 
    }

    .logo {
        max-width: 170px; 
        height: auto;
        margin-bottom: -10px; 
    }
    </style>

</head>
<body>
    <div class="form-container">
    <img src="./uploads/1.png" alt="Decoration Company Logo" class="logo">
        <h2>Login Form</h2><br>
        <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
        <form id="loginForm" action="#" method="POST" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                <span class="error" id="usernameError"></span>
            </div>

            <div class="form-group password-container">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <span class="eye-icon" id="togglePassword">
                    <i class="fas fa-eye"></i>
                </span>
                <span class="error" id="passwordError"></span>
            </div>

            <button type="submit">Login</button>
            <a href="./registration.php">Don't have an account? Register here</a>
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

        function validateForm() {
            let valid = true;

            document.getElementById('usernameError').innerText = '';
            document.getElementById('passwordError').innerText = '';

            // Validate username
            const username = document.getElementById('username').value.trim();
            if (username === '') {
                document.getElementById('usernameError').innerText = 'Username is required.';
                valid = false;
            }

            // Validate password
            const password = passwordInput.value.trim();
            if (password === '') {
                document.getElementById('passwordError').innerText = 'Password is required.';
                valid = false;
            } else if (password.length < 6) {
                document.getElementById('passwordError').innerText = 'Password must be at least 6 characters.';
                valid = false;
            }

            return valid;
        }
    </script>
</body>
</html>
