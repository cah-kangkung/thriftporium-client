<?php
defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class Cart_model extends CI_Model
{

    private $_client;

    public function __construct()
    {
        $this->_client = new Client([
            'base_uri' => 'http://api.thriftporium.id',
            'auth' => ['dev', '123456'],
        ]);
    }

    public function get_cart_products($id)
    {
        try {
            $response = $this->_client->request('GET', 'user/cart', [
                'query' => [
                    'user' => $id,
                ]
            ]);
        } catch (\Throwable $e) {
            return null;
        }

        $result = json_decode($response->getBody()->getContents(), true);

        return $result['data'];
    }

    public function add_to_cart($data = array(), $id)
    {
        try {
            $response = $this->_client->request('POST', 'user/cart/' . $id, [
                'json' => $data,
            ]);
        } catch (RequestException $e) {
            return json_decode($e->getResponse()->getBody()->getContents(), true);
        }

        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function edit_cart($data = array(), $id)
    {
        try {
            $response = $this->_client->request('PUT', 'user/cart/' . $id, [
                'json' => $data,
            ]);
        } catch (RequestException $e) {
            return json_decode($e->getResponse()->getBody()->getContents(), true);
        }

        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function delete_cart($id, $product_id)
    {
        try {
            $response = $this->_client->request('DELETE', 'user/cart/' . $id . '/' . $product_id);
        } catch (RequestException $e) {
            return json_decode($e->getResponse()->getBody()->getContents(), true);
        }

        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }
}
