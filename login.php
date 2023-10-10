<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
    <style>
        body {
            background: linear-gradient(45deg, #FFC300, #FF5733, #C70039, #900C3F);
            background-size: 400% 400%;
            animation: gradientAnimation 15s ease infinite;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            color: white;
            font-family: Arial, sans-serif;
            text-align: center;
        }

        @keyframes gradientAnimation {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }

        .error-message {
            font-size: 36px !important; /* Dodane !important, aby zapewnić, że styl zostanie nadpisany */
            margin-top: 20px;
        }

        .logout-button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            font-size: 18px;
            margin-top: 20px;
            text-decoration: none;
        }

        .logout-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<?php
    session_start();

    // Połączenie z bazą danych (host, username, password, dbname)
    $conn = new mysqli("******", "*****", "****", "******");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT id FROM users WHERE username='$username' AND password='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $_SESSION['username'] = $username;
            header("location: welcome.php");
        } else {
            echo "<div class='error-message'><span class='error-text'>Błędna nazwa użytkownika lub hasło.</span></div>";
        }
    }

    $conn->close();
    ?>
    <a href="index.html" class="logout-button">Wyloguj się</a>
</body>
</html>