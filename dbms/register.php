<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = ""; // Cambia se hai impostato una password
$dbname = "login";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Inizializza una variabile per i messaggi di errore
$error_message = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $pass = trim($_POST['password']);
    $name = trim($_POST['name']);

    // Validate input
    if (empty($email) || empty($pass) || empty($name)) {
        $error_message = "Please fill in all fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email format.";
    } elseif (strlen($pass) < 8) {
        $error_message = "Password must be at least 8 characters long.";
    } else {
        // Check if email already exists
        $checkEmailSql = "SELECT id FROM users WHERE email = ?";
        $checkStmt = $conn->prepare($checkEmailSql);
        $checkStmt->bind_param("s", $email);
        $checkStmt->execute();
        $checkStmt->store_result();

        if ($checkStmt->num_rows > 0) {
            $_SESSION["setemail"] = true;
            header("Location: ../registers.php");
            exit;
        } else {
            

            // Insert user into database
            $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                $error_message = "Error preparing statement: " . $conn->error;
            } else {
                $stmt->bind_param("sss", $name, $email, $pass);

                if ($stmt->execute()) {
                    // Imposta i cookie
                    setcookie("name", $name, time() + (86400 * 7), "/");
                    setcookie("user_email", $email, time() + (7 * 24 * 60 * 60), "/");

                    // Reindirizza l'utente a una pagina di benvenuto
                    header("Location: ../welcome.php");
                    exit;
                } else {
                    $error_message = "Error: " . $stmt->error;
                }
                $stmt->close();
            }
        }
        $checkStmt->close();
    }
}

$conn->close();
?>

