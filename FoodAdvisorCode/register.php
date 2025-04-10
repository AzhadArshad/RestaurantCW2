<?php
include("db_connect.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        echo "Account created. <a href='login.php'>Login</a>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>


<form method="post">
<h2>Register</h2>
    <input name="username" placeholder="Username" required><br>
    <input name="password" type="password" placeholder="Password" required><br>
    <button type="submit">Register</button>
</form>
<style>
    body {
        font-family: Arial, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        background: url('images/f0b615f78dd809d68ec389f4bc8d94bb.jpg') no-repeat center center fixed;
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
</style>