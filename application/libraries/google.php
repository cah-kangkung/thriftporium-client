<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Google
{
    private $client;

    public function __construct()
    {
        $CI = &get_instance();
        $CI->config->load('googleplus');

        $this->client = new Google_Client();
        // $client->setAuthConfig('client_secret.json');

        // thriftporium client and secret id
        $this->client->setApplicationName($CI->config->item('application_name', 'googleplus'));
        $this->client->setClientId($CI->config->item('client_id', 'googleplus'));
        $this->client->setClientSecret($CI->config->item('client_secret', 'googleplus'));
        $this->client->setRedirectUri($CI->config->item('redirect_uri', 'googleplus'));
        $this->client->setDeveloperKey($CI->config->item('api_key', 'googleplus'));
        $this->client->setScopes($CI->config->item('scopes', 'googleplus'));
        $this->client->setAccessType('online');
        $this->client->setApprovalPrompt('auto');
        $this->google_oauth = new Google_Service_Oauth2($this->client);
    }

    public function getURL()
    {
        return $this->client->createAuthUrl();
    }

    public function setAuthenticate($code)
    {
        return $this->client->fetchAccessTokenWithAuthCode($code);
    }

    public function getAccessToken()
    {
        return $this->client->getAccessToken();
    }

    public function setAccessToken($token)
    {
        return $this->client->setAccessToken($token);
    }

    public function revokeToken($token = null)
    {
        return $this->client->revokeToken($token);
    }

    public function getUserInfo()
    {
        return $this->google_oauth->userinfo->get();
    }
}
