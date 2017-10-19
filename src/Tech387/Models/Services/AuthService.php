<?php

namespace Tech387\Models\Services;

use Tech387\Models\Mappers;
use Tech387\Core\Mapper\CanCreateMapper;
use Tech387\Models\Entities\Admin;
use Tech387\Models\Entities\Blog;
use Tech387\Models\Entities\Auth;

class AuthService
{
    private $factory;
    public $storage;
    private $server;
    private $configuration;

    public function __construct(CanCreateMapper $factory)
    {
        $this->factory = $factory;

        //get connection & configuration
        $mapper = $this->factory->create(\Tech387\Models\Mappers\AuthMapper::class);
        $connection = $mapper->getConnection();
        $this->configuration = $mapper->getConfiguration();

        $this->storage = new \OAuth2\Storage\Pdo($connection);
        $this->server = new \OAuth2\Server($this->storage);

        // User credentials
        $this->server->addGrantType(new \OAuth2\GrantType\UserCredentials($this->storage));

        // Add the "Client Credentials" grant type (it is the simplest of the grant types)
        $this->server->addGrantType(new \OAuth2\GrantType\ClientCredentials($this->storage));

        // create the grant type
        $this->server->addGrantType(new \OAuth2\GrantType\RefreshToken($this->storage,array(
            'always_issue_new_refresh_token' => true
        )));
    }

    /**
     * Get Login Link
     */
    public function getLogin()
    {
        $auth = new Auth();

        $mapper = $this->factory->create(\Tech387\Models\Mappers\AuthMapper::class);
        $mapper->generateAuthLink($auth);
        
        return $auth->getResponse();
    }

    /**
     * Callback
     */
    public function callback($callback)
    {
        $auth = new Auth();

        //Set callbck code
        $auth->setCode($callback);
        
        //Setup mapper
        $mapper = $this->factory->create(\Tech387\Models\Mappers\AuthMapper::class);
        //handle auth code
        $mapper->codeAuth($auth);

        //get payload
        $payload = $auth->getResponse()['id_token'];
        $auth->setPayload($payload);
        $mapper->handlePayload($auth);

        if(isset($auth->getResponse()['email'])){

            $payload = $auth->getResponse();
            $auth->setUserId($payload['azp']);
            //$auth->setName($payload['name']);
            $auth->setEmail($payload['email']);

            //check is user is in database
            $mapper->getUserName($auth);
            
            //if exsists assign set name
            if(isset($auth->getResponse()['username'])){
                $auth->setName($auth->getResponse()['username']);
            }

            //auth
            $response = $this->getUserAccessToken('client_id','client_secret',$auth->getName(),'password');
            $response = json_decode($response,true);
 
            if(isset($response['access_token'])){
                return [
                    'status'=>200,
                    'url'=>$this->configuration['frontend_url'].'?access_token='.$response['access_token'].'&refresh_token='.$response['refresh_token']
                ];
            }
            
            //Not working being redirected
            return [
                'status'=>300,
                'url'=>$this->configuration['frontend_url'].'?error=Error while login'
            ];
        }
        //Not working being redirected
        return [
            'status'=>300,
            'url'=>$this->configuration['frontend_url'].'?error=Error while login'
        ];
    }

    /**
     * Return Access Token
     */
    public function returnToken($requestObject)
    {
        //NOTE Reponse.php -> send needs to return not to echo! change it
        $json = (string)$this->server->handleTokenRequest($requestObject)->send();
    
        return json_decode($json,true);
    }

    /**
     * Validate Access Token
     */
    public function validateAccessToken()//TODO
    {
        if (!$this->server->verifyResourceRequest(\OAuth2\Request::createFromGlobals(),null,$scope)) {
            return false;
        }
        return true;
    }

    /**
     * Get Access Token Info
     */
    public function getAccessToken()
    {
        $data = $this->server->getAccessTokenData(\OAuth2\Request::createFromGlobals());
        return $data;
    }

    /**
     * Get User Access Token
     */
    public function getUserAccessToken($clientId,$clientSecret,$userName,$password)
    {
        $client = new \GuzzleHttp\Client(
            [
                'base_uri' => $this->configuration['url']
            ]
        );
        $credentials = base64_encode($clientId.':'.$clientSecret);
              
        $response = $client->post('/auth/token',
            [
                'headers' => [
                    'Authorization' => 'Basic ' . $credentials,
                    'Content-Type:application/x-www-form-urlencoded'
                ],
                'form_params' => [
                    'grant_type' => 'password',
                    'username' => $userName,
                    'password' => $password
                ]
            ]
        );
        return $response->getBody()->getContents();
    }

    /**
     * Handle Request Validity
     */
    public function handleRequestValidity()
    {
        return $this->server->verifyResourceRequest(\OAuth2\Request::createFromGlobals());
    }   
}