
<?php
defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class Payment_model extends CI_Model
{

    private $_client;

    public function __construct()
    {
        $this->_client = new Client([
            'base_uri' => 'http://api.thriftporium.id',
            'auth' => ['dev', '123456'],
        ]);
    }

    public function get_payment($value, $type = 'id')
    {
        try {
            $response = $this->_client->request('GET', 'payment', [
                'query' => [
                    $type => $value,
                ]
            ]);
        } catch (\Throwable $e) {
            return null;
        }

        $result = json_decode($response->getBody()->getContents(), true);

        return $result['data'];
    }

    public function get_all_payment()
    {
        try {
            $response = $this->_client->request('GET', 'payment');
        } catch (\Throwable $e) {
            return null;
        }

        $result = json_decode($response->getBody()->getContents(), true);

        return $result['data'];
    }

    public function create_payment($data = array())
    {
        try {
            $response = $this->_client->request('POST', 'payment', [
                'json' => $data,
            ]);
        } catch (RequestException $e) {
            return json_decode($e->getResponse()->getBody()->getContents(), true);
        }

        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function edit_payment($data = array(), $id)
    {
        try {
            $response = $this->_client->request('PUT', 'payment/' . $id, [
                'json' => $data,
            ]);
        } catch (RequestException $e) {
            return json_decode($e->getResponse()->getBody()->getContents(), true);
        }

        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }
}
