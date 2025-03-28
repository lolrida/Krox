<?php
    session_start();
    if(isset($_COOKIE['setemail'])) {
        echo "<script>alert('Email already exists.')</script>";
        setcookie('setemail', '', time() - 3600, '/');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="icon" type="image/png" href="./images/alien.png">
    <title>Krox</title>
</head>
<body class="bg-blue-950 container ">

<div class="flex items-center justify-center min-h-screen ml-50">
    <form action="./dbms/register.php" class="form" method="post">
        <p>
            Welcome, <span>Sign up to continue</span>
        </p>
        <input type="text" placeholder="Name" name="name" required>
        <input type="email" placeholder="Email" name="email" required>
        <input type="password" placeholder="Password" name="password" required>
        

        <button class="oauthButton">
            Continue
            <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 17 5-5-5-5"></path><path d="m13 17 5-5-5-5"></path></svg>
        </button>
        <p>        
            <span>Do you have an account ?  <a href="./index.php" class="text-slate-950">Sign in</a></span>
        </p>
    </form></span>
</div>


    
</body>
</html>