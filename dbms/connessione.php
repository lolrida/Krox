<?php
session_start();
// Connessione al database
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "login"; 

$conn = new mysqli($servername, $username, $password, $dbname);

// Controlla la connessione
if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
} else {
    header('Location: ./insert-user.php');
}

?>