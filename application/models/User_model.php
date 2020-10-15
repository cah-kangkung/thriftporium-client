<?php
defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class User_model extends CI_Model
{

    private $_client;

    public function __construct()
    {
        $this->_client = new Client([
            'base_uri' => 'http://api.thriftporium.id/',
            'auth' => ['dev', '123456'],
        ]);
    }

    public function get_user($value, $type = 'id')
    {
        try {
            $response = $this->_client->request('GET', 'user', [
                'query' => [
                    $type => $value,
                ]
            ]);
        } catch (\Throwable $e) {
            return null;
        }

        $result = json_decode($response->getBody()->getContents(), true);

        return $result['data'][0];
    }

    public function get_all_user()
    {
        try {
            $response = $this->_client->request('GET', 'user');
        } catch (\Throwable $e) {
            return null;
        }

        $result = json_decode($response->getBody()->getContents(), true);
        return $result['data'];
    }

    public function create_user($data = array())
    {
        try {
            $response = $this->_client->request('POST', 'user', [
                'json' => $data,
            ]);
        } catch (RequestException $e) {
            return json_decode($e->getResponse()->getBody()->getContents(), true);
        }

        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function update_user($data = array(), $id)
    {
        try {
            $response = $this->_client->request('PUT', 'user/' . $id, [
                'json' => $data,
            ]);
        } catch (RequestException $e) {
            return json_decode($e->getResponse()->getBody()->getContents(), true);
        }

        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function change_password($data = array(), $id)
    {
        try {
            $response = $this->_client->request('PUT', 'user/password/' . $id, [
                'json' => $data,
            ]);
        } catch (RequestException $e) {
            return json_decode($e->getResponse()->getBody()->getContents(), true);
        }

        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }
}
