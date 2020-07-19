<?php
namespace Providers;

class ProviderHandler {
	protected $name;
	protected $client_id;
	protected $client_Secret;
	protected $url;
	protected $response_type;
	protected $state;
	protected $scop;
	protected $uri;
	protected $redirectUri = "http://localhost:7071/success";

    public function __construct(string $client_id, string $client_secret){
		$this->client_id = $client_id;
		$this->client_secret = $client_secret;
	}

	public function displayLink() {
		echo "<a href=\"{$this->uri}\">Connexion avec $this->nameProvider</a>";
	}

	public function getLink(): string
    {
        $parameter = [
            'client_id' => $this->client_Id,
            'state' => $this->state,
            'redirect_uri' => $this->uri,
            'scope' => isset($this->scope) ? $this->scope : null
        ];

        return "{$this->accessLink}?".http_build_query($parameter);
    }
	
}
