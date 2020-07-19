<?php
namespace Providers;

class Provider {
	protected $nameProvider;
	protected $client_Id;
	protected $client_Secret;
	protected $state;
	protected $uri;
	protected $accessLink;

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
