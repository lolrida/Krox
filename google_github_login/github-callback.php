<?php
session_start();

$client_id = getenv('GITHUB_CLIENT_ID'); 
$client_secret = getenv('GITHUB_CLIENT_SECRET');
if (empty($client_id) || empty($client_secret)) {
    die("Client ID o Client Secret non configurati.");
}
$github_login_url = "https://github.com/login/oauth/authorize?client_id=$client_id&redirect_uri=$redirect_uri&scope=user:email";
if (isset($_GET['code'])) {
    // Scambia il codice per un access token
    $code = $_GET['code'];
    $token_url = "https://github.com/login/oauth/access_token";
    $post_data = [
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'code' => $code,
        'redirect_uri' => $redirect_uri
    ];

    $ch = curl_init($token_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Accept: application/json']);
    $response = curl_exec($ch);
    curl_close($ch);

    $token_data = json_decode($response, true);

    if (isset($token_data['access_token'])) {
        // Usa l'access token per ottenere le informazioni dell'utente
        $access_token = $token_data['access_token'];
        $user_url = "https://api.github.com/user";
        $ch = curl_init($user_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: token $access_token",
            "User-Agent: ProvaLoginApp"
        ]);
        $user_response = curl_exec($ch);
        curl_close($ch);

        $user_data = json_decode($user_response, true);

        if (isset($user_data['login'])) {
            // Salva i dati dell'utente nella sessione
            $_SESSION['user_email'] = $user_data['email'] ?? 'email non disponibile';
            $_SESSION['user_name'] = $user_data['name'] ?? $user_data['login'];
            $_SESSION['access_token'] = $access_token;

            // Reindirizza alla pagina di benvenuto
            header("Location: ../welcome.php");
            exit;
        } else {
            echo "Errore: Impossibile ottenere i dati dell'utente.";
        }
    } else {
        echo "Errore: Impossibile ottenere l'access token.";
    }
} else {
    echo "Errore: Codice di autorizzazione non ricevuto.";
}
?>