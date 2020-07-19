<?php
session_start();

use Providers\providerLocal;
use Providers\providerLinkedin;
use Providers\providerGithub;

function autoloader($className)
{
    // Reprise du code vu en cours de php2 pour l'autoloader
    $class = __DIR__. "/".$class.".php";
    if(file_exists($class)){
        include $class;
    }
}

function home()
{
    global $CLIENT_ID_LOCAL;
    global $STATE_LOCAL;
    global $LOCAL_URL;
    $link = "http://localhost:7070/auth?response_type=code&client_id={$CLIENT_ID}&state={$STATE}&scope=email&redirect_uri={$LOCAL_URL}/success";

    echo "<a href=\"{$link}\">Se connecter via OauthServer</a>";
}

function callback()
{

    
        $provider = new $_GET['state']();
        $provider->getInfosClient();
   
    /*

    ['code' => $code, 'state' => $rstate] = $_GET;

    // Check state origin
    if ($STATE === $rstate) {
        // Get access token
        $link = "http://oauth-server/token?grant_type=authorization_code&code={$code}&client_id={$CLIENT_ID}&client_secret={$CLIENT_SECRET}";
        ['token' => $token] = json_decode(file_get_contents($link), true);

        // Get user data
        $link = "http://oauth-server/me";
        $rs = curl_init($link);
        curl_setopt_array($rs, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => 0,
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer {$token}"
            ]
        ]);
        echo curl_exec($rs);
        curl_close($rs);
    } else {
        http_response_code(400);
        echo "Invalid state";
    } */
}

// Router
$route = strtok($_SERVER['REQUEST_URI'], '?');
switch ($route) {
    case '/':
        home();
        break;
    case '/success':
        callback();
        break;
}