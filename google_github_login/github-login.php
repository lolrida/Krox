<?php
session_start();

$client_id = 'Ov23likdWE1IG7W8BbxM';
$redirect_uri = 'http://localhost/provalogin/google_github_login/github-callback.php';

// Genera un URL per il login con GitHub
$github_login_url = "https://github.com/login/oauth/authorize?client_id=$client_id&redirect_uri=$redirect_uri&scope=user:email";

// Reindirizza l'utente alla pagina di login di GitHub
header("Location: $github_login_url");
exit;
?>