<?php
// Abilita la visualizzazione degli errori
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$client_id = '561213811356-k41ehq89ka0orou982ml0k3ppjpeinhe.apps.googleusercontent.com';
$client_secret = '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';
$redirect_uri = 'http://localhost/provalogin/google_github_login/google-callback.php';

if (isset($_GET['code'])) {
    $code = $_GET['code'];

    // Scambia il codice per un token di accesso
    $url = 'https://oauth2.googleapis.com/token';
    $data = [
        'code' => $code,
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'redirect_uri' => $redirect_uri,
        'grant_type' => 'authorization_code',
    ];

    $options = [
        'http' => [
            'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data),
        ],
    ];

    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);

    // Controlla se la richiesta è fallita
    if ($response === false) {
        die('Errore nella richiesta del token');
    }

    $token = json_decode($response, true);

    // Verifica se il token è stato ricevuto
    if (!isset($token['access_token'])) {
        die('Token di accesso non ricevuto: ' . $response);
    }

    // Ottieni i dati dell'utente
    $userInfo = file_get_contents('https://www.googleapis.com/oauth2/v1/userinfo?access_token=' . $token['access_token']);
    if ($userInfo === false) {
        die('Errore nel recuperare i dati dell\'utente');
    }

    $user = json_decode($userInfo, true);

    // Stampa i dati dell'utente
    if ($user) {
        echo '<pre>';
        print_r($user);
        echo '</pre>';
    } else {
        echo 'Errore: dati utente non validi';
    }
} else {
    echo 'Nessun codice ricevuto. Assicurati di essere reindirizzato da Google con il parametro "code".';
}
?>