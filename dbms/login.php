<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if ($password === $user['password']) {
            $_SESSION['loggedin'] = true;
            $_SESSION['user_name'] = $user['name'];
            header("Location: ../welcome.php");
            exit;
        } else {
            echo "Password errata.";
        }
    } else {
        $_SESSION['error_message'] = true;
        header("Location: ../index.php");
        exit;
    }

    $stmt->close();
}

$conn->close();
?>