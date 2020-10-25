
<?php
defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class Order_model extends CI_Model
{

    private $_client;

    public function __construct()
    {
        $this->_client = new Client([
            'base_uri' => 'http://api.thriftporium.id',
            'auth' => ['dev', '123456'],
        ]);
    }

    public function get_order($value, $type = 'id')
    {
        try {
            $response = $this->_client->request('GET', 'order', [
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

    public function get_all_order()
    {
        try {
            $response = $this->_client->request('GET', 'order');
        } catch (\Throwable $e) {
            return null;
        }

        $result = json_decode($response->getBody()->getContents(), true);

        return $result['data'];
    }

    public function create_order($data = array())
    {
        try {
            $response = $this->_client->request('POST', 'order', [
                'json' => $data,
            ]);
        } catch (RequestException $e) {
            return json_decode($e->getResponse()->getBody()->getContents(), true);
        }

        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function edit_order($data = array(), $id)
    {
        try {
            $response = $this->_client->request('PUT', 'order/' . $id, [
                'json' => $data,
            ]);
        } catch (RequestException $e) {
            return json_decode($e->getResponse()->getBody()->getContents(), true);
        }

        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }
}
