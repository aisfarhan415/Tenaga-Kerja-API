<?php
function getAccessToken($username, $password) {
    $url = 'http://34.101.235.69/ekatalog/apiv1/request_token';

    $data = array(
        'username' => $username,
        'password' => $password
    );

    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

    $response = curl_exec($ch);

    curl_close($ch);

    return json_decode($response, true);
}

$username = "USERNAME_SECRET";
$password = "PASSWORD_SECRET";
$tokenData = getAccessToken($username, $password);

print_r($tokenData);
?>
