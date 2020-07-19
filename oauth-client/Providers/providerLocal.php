<?php
namespace Providers;
use Providers\providerHandler;

class ProviderLocal extends Provider
{

protected $name = "providerLocal";
protected $client_id = "client_5edfd43b0db573.88203718";
protected $client_secret="e0a6a1f5c55fafd48cbcce2b7279d4029fad76f4";
protected $url = "http://localhost:7070/auth";
protected $response_type = "code";
protected $scop = "email";
protected $state = "DEAZFAEF321432DAEAFD3E13223R";
//protected $redirectUri = "http://localhost:7071/success";

    public function __construct(string $client_id, string $client_secret)
    {
        parent::__construct($client_id, $client_secret);
    }

    public function getProviderLocal() {

        ['code' => $code, 'state' => $rstate] = $_GET;

        // Check state origin
        if ($STATE === $rstate) {
        // Get access token
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
    }
    }
}