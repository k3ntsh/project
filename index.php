<?php
// Agar Method ["POST"] Bod Data Ro Save Mikone 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Meghdar Haye Vorodi Ro Taeen Mikone
    $username = trim($_POST['username']); //UserName Fard
    $email = trim($_POST['email']); // Email Fard
    $password = trim($_POST['password']); // Password Fard
    
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Password = password (default)

    // Vorod be Data Base (local host)
    $conn = new mysqli('localhost', 'root', '', '[Esme DataBase]');

    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO signup (username, email, password) VALUES (?, ?, ?)");
    if ($stmt === false) {
        die('Prepare failed: ' . $conn->error);
    }

    $stmt->bind_param("sss", $username, $email, $hashed_password);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Sign up was successful!";
    } else {
        echo "Sign up failed. Please try again.";
    }
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
