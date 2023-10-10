<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Witaj!</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            text-align: center;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            background-color: #f2f2f2;
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
        }

        a {
            color: #3498db;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
        .user-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .delete-button {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .delete-button:hover {
            background-color: #c0392b;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Witaj!</h1>
        <p>Oto lista wszystkich użytkowników:</p>
        <ul>
            <?php
            // Połączenie z bazą danych (host, username, password, dbname)
            $conn = new mysqli("******", "*****", "****", "******");

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_user"])) {
                // Usuń użytkownika z bazy danych
                $username_to_delete = $_POST["delete_user"];
                $sql = "DELETE FROM users WHERE username='$username_to_delete'";
                if ($conn->query($sql) === TRUE) {
                    echo "<p>Użytkownik '$username_to_delete' został usunięty.</p>";
                } else {
                    echo "<p>Błąd podczas usuwania użytkownika: " . $conn->error . "</p>";
                }
            }

            
            $sql = "SELECT username FROM users";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<li class='user-item'><span>" . htmlspecialchars($row["username"]) . "</span> <form method='post'><button type='submit' name='delete_user' value='" . htmlspecialchars($row["username"]) . "' class='delete-button'>Usuń</button></form></li>";
                }
            } else {
                echo "<li>Brak użytkowników w bazie danych.</li>";
            }

            $conn->close();
            ?>
        </ul>
        <p><a href="logout.php">Wyloguj się</a></p>
    </div>
</body>

</html>