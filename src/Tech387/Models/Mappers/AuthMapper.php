<?php

namespace Tech387\Models\Mappers;

use PDO;
use PDOException;
use Tech387\Core\Component\DataMapper;
use Tech387\Models\Entities;

class AuthMapper extends DataMapper
{

    public function getConnection()
    {
        return $this->connection;
    }

    public function getConfiguration()
    {
        return $this->configuration;
    }

    /**
     * Get User name by mail
     */
    public function getUserName(Entities\Auth $auth)
    {
        try{
            $sql = "SELECT username FROM oauth_users WHERE email = ?";
            $statement = $this->connection->prepare($sql);
            $statement->execute(
                [
                    $auth->getEmail()
                ]
            );
            $response = $statement->fetch(PDO::FETCH_ASSOC);
        }catch(\PDOException $e){
            $response = ['status'=>200,'message'=>$e->getMessage()];
        }
        $auth->setResponse($response);
    }

    /**
     * Generate Login Link
     */
    public function generateAuthLink(Entities\Auth $auth)
    {
        try{
            //Setup google auth
            $client = new \Google_Client();
            //Configure auth
            $client->setClientId($this->configuration['client_id']);
            $client->setClientSecret($this->configuration['client_secret']);
            $client->setRedirectUri($this->configuration['redirect_url']);
            $client->setAccessType("offline");
            $client->setIncludeGrantedScopes(true);
            $client->addScope(\Google_Service_Plus::USERINFO_EMAIL);
            $auth_url = $client->createAuthUrl();

            $response = ['url'=>$auth_url];
        }catch(\Exception $e){
            $response = ['status' => 406,'message'=>$e->getMessage()];
        }

        $auth->setResponse($response);
    }

    /**
     * Code Auth
     * returns access token with additional data
     */
    public function codeAuth(Entities\Auth $auth)
    {
        try{
            //Setup google auth
            $client = new \Google_Client();
            //Configure auth
            $client->setClientId($this->configuration['client_id']);
            $client->setClientSecret($this->configuration['client_secret']);
            $client->setRedirectUri($this->configuration['redirect_url']);
            $client->setScopes( [ 'email', 'profile' ] );
            $response = $client->fetchAccessTokenWithAuthCode($auth->getCode());
        }catch(\Exception $e){
            $response = ['status'=>406,'Message'=>'Unable to handle code form auth'];
        }
        $auth->setResponse($response);
    }

    /**
     * Handle Payload
     */
    public function handlePayload(Entities\Auth $auth)
    {
        try{
            //Setup google auth
            $client = new \Google_Client();
            //Configure auth
            $client->setClientId($this->configuration['client_id']);
            $client->setClientSecret($this->configuration['client_secret']);
            $client->setRedirectUri($this->configuration['redirect_url']);
            $client->setScopes( [ 'email', 'profile' ] );
            $response = $client->verifyIdToken($auth->getPayload());
        }catch(\Exception $e){
            $response = ['status'=>406,'Message'=>'Handle Payload'];
            //Monolog Logging
            $this->logger->addError('handle payload Auth'."|".$e->getMessage());
        }
        $auth->setResponse($response);
    }

}