<?php
// filepath: /opt/lampp/htdocs/provalogin/google-login.php
$client_id = '561213811356-k41ehq89ka0orou982ml0k3ppjpeinhe.apps.googleusercontent.com';
$redirect_uri = 'http://localhost/provalogin/google_github_login/google-callback.php';
$scope = 'email profile';

header('Location: https://accounts.google.com/o/oauth2/auth?response_type=code&client_id=' . $client_id . '&redirect_uri=' . urlencode($redirect_uri) . '&scope=' . urlencode($scope));
exit;
?>