<?php
session_start();

// Controlla se l'utente è loggato
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Reindirizza alla pagina di login
    header("Location: ./index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>    
    <link rel="icon" type="image/png" href="./images/alien.png">
    <title>Krox - Welcome</title>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center">
    <!-- Header -->
    <header class="w-full bg-gray-800 text-white p-4 flex justify-between items-center">
        <div class="flex items-center">
            <img src="./images/alien.png" alt="Logo" class="h-10 w-auto">
            <h1 class="text-lg font-semibold ml-4">Krox</h1>
        </div>
        <div class="">
            <button
            class="bg-white text-center w-48 rounded-2xl h-14 relative text-black text-xl font-semibold group"
            type="button"
            onclick="window.location.href='./logout.php';"
            >
            <div
            class="bg-green-500 rounded-xl h-12 w-1/4 flex items-center justify-center absolute left-1 top-[4px] group-hover:w-[184px] z-10 duration-500"
            >
            <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 1024 1024"
            height="25px"
            width="25px"
            >
            <path
                d="M224 480h640a32 32 0 1 1 0 64H224a32 32 0 0 1 0-64z"
                fill="#000000"
            ></path>
            <path
                d="m237.248 512 265.408 265.344a32 32 0 0 1-45.312 45.312l-288-288a32 32 0 0 1 0-45.312l288-288a32 32 0 1 1 45.312 45.312L237.248 512z"
                fill="#000000"
            ></path>
            </svg>
            </div>
            <p class="translate-x-2">Logout</p>
        </button>
        </div>
    </header>

   
</body>
</html>