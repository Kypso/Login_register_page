<?php
// Połączenie z bazą danych (host, username, password, dbname)
$conn = new mysqli("******", "*****", "****", "******");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        // Udana rejestracja, wyświetl komunikat
        echo "<div style='text-align:center; margin-top: 20px;'>Zarejestrowano pomyślnie. Teraz możesz się <a href='index.html'>zalogować</a>.</div>";
    } else {
        echo "Błąd podczas rejestracji: " . $conn->error;
    }
}

$conn->close();
?>