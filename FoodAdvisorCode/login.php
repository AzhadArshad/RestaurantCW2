<?php

include('db_connect.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Debugging: Check if the password field is set
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Sanitize the inputs to prevent SQL injection
        $username = $conn->real_escape_string($username);
        $password = $conn->real_escape_string($password);

        // Query the database to check if the username exists
        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Check if the provided password matches the hashed password stored in the database
            if ($password === $user['password']) {
                // Correct username and password, set session variables
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['username'] = $user['userName'];
                header("Location: index.php");  // Redirect to a dashboard or protected page
                exit;
            } else {
                echo "<script>alert('Invalid password.TRY AGAIN :('); window.location.href = 'login.php';</script>";
            }
        } else {
            echo "<script>alert('Invalid username. TRY AGAIN :('); window.location.href = 'login.php';</script>";
        }
    } else {
        echo "<script>alert('Please enter both username and password. TRY AGAIN :('); window.location.href = 'login.php';</script>";
    }
}

?>


<form method="post" action=login.php>
<header class="header">
        <h1>"<span>People who love to eat</span> are the best people"</h1>
    </header>
<h2>YOUR PERSONAL FOOD ADVISOR </h2>
    <input name="username" placeholder="Username"><br>
    <input type="password" name="password" id="password" required placeholder="Password"><br>
    <input type="checkbox" onclick="togglePassword()"> Show Password
    <script>
        function togglePassword() {
            var passwordField = document.getElementById("password");
            if (passwordField.type === "password") {
                passwordField.type = "text";
            } else {
                passwordField.type = "password";
            }
        }
    </script>
    <button type="submit">LOGIN</button>
</form>

<style>
    
    body {
        font-family: Arial, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        background: url('images/drawn-food-background-doodle-food-illustration-with-place-for-text-vector.jpg') no-repeat center center fixed;
        background-size: cover;
    }

    form {
        background-color: rgba(255, 255, 255, 0.8); /* Transparent background */
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 300px;
        text-align: center;
    }

    h2 {
        margin-bottom: 20px;
        font-size: 24px;
        color: #333;
    }

    input[name="username"],
    input[type="password"],
    input[type="checkbox"] {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    input[type="password"] {
        width: calc(100% - 22px);
    }

    input[type="checkbox"] {
        width: auto;
        display: inline-block;
        margin-right: 5px;
    }

    button {
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 5px;
        background-color: #4CAF50;
        color: white;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    button:hover {
        background-color: #45a049;
    }

    .remember-me {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .remember-me label {
        margin-left: 5px;
    }

    .show-password {
        text-align: left;
    }
    .header {
            background-color: #588157;
            color: white;
            text-align: center;
            padding: 30px 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .header h1 {
            margin: 0;
            font-size: 2.2rem;
            font-weight: 300;
            letter-spacing: 1px;
        }

        .header h1 span {
            font-weight: 600;
        }

        @media (max-width: 600px) {
            .header h1 {
                font-size: 1.8rem;
            }
        }
</style>
