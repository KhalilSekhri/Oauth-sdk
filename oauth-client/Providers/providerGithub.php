<?
namespace Providers;
use Providers\providerHandler;

class GitHubProvider extends Provider
{

    protected $name = "ProviderGitHub";
    protected $client_id = "0fa761508f7ae7b7fe18";
    protected $client_secret="cf7843945b8f3406bb7c6683a99afa24bbe90780";
    protected $url = "https://api.github.com/";
    protected $scope = "login";
    protected $state = "github";
    protected $linkAutorisation = "https://github.com/login/oauth/authorize";
    protected $linkAccessToken = "https://github.com/login/oauth/access_token";
    protected $redirect_url = "http://localhost:7071/sucess";


    public function construct(string $client_id, string $client_secret)
    {
        parent::construct();
        //$this->url= $this->url ."?response_type=code&client_id={$this->client_id}&state={$this->state}&scope={$this->scope}&redirect_uri={$this->redirect_url}";
    }

    public function getProviderGitHub() {

        ['code' => $code, 'state' => $rstate] = $_GET;

        // Check state origin
        if ($state === $rstate) {
            // Get access token
            //$link = "http://oauth-server/token?grant_type=authorization_code&code=%7B$this-%3Ecode%7D&client_id=%7B$this-%3Eclient_id%7D&client_secret=%7B$this-%3Eclient_secret%7D";
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

            $tr = curl_init($rs);
            echo curl_exec($rs);
            curl_close($rs);
        } 

        else {
            http_response_code(400);
            echo "Invalid state";
    } 
}
}