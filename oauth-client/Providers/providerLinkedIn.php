<?php
namespace Providers;

class ProviderLinkedin extends Provider
{

protected $name = "LinkedInProvider";
protected $client_id = "77ybkwsf25j6k7";
protected $client_secret="pHI3BtxnPMdz7xXA";
protected $url = "https://api.linkedin.com/v2";
protected $scope = "email";
protected $state = "LinkedIn";
protected $accessLink = "https://www.linkedin.com/oauth/v2/authorization";
protected $uriAuth = "https://www.linkedin.com/oauth/v2/accessToken";

    public function __construct(string $client_id, string $client_secret)
    {
        arent::__construct($client_id, $client_secret);
        $this->url= $this->url ."?response_type=code&client_id={$this->client_id}&state={$this->state}&scope={$this->scope}&redirect_uri={$this->redirect_url}";
    }

    public function getInfosClient() {


        ['code' => $code, 'state' => $rstate] = $_GET;
    
        // Check state origin
        if ($state === $rstate) {
            // Get access token
            //$link = "http://oauth-server/token?grant_type=authorization_code&code={$this->code}&client_id={$this->client_id}&client_secret={$this->client_secret}";
            $link = [
                "client_id" => $this->client_id,
                "client_secret" => $this->client_secret,
                "code" => $code,
              ];
  
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
            $tr = curl_init($this->accessLink);
            echo curl_exec($rs);
            curl_close($rs);
        } else {
            http_response_code(400);
            echo "Invalid state";

            
            $tr = curl_init('https://github.com/login/oauth/access_token');
            curl_setopt($tr, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($tr, CURLOPT_POSTFIELDS, $post);
            
            $response = curl_exec($tr);

            curl_close($tr);

            //parse response
            $responseParams = explode('&', $response);
            $parsedToken = explode('=', $responseParams[0]);
            $token = $parsedToken[1];


	        echo curl_exec($ufr);
	        curl_close($ufr);
	    } else {
	        http_response_code(400);
	        echo "Invalid state";
	    } 
	} 

}
