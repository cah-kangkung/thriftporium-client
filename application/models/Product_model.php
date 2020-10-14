<?php
defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class Product_model extends CI_Model
{

    private $_client;

    public function __construct()
    {
        $this->_client = new Client([
            'base_uri' => 'http://api.thriftporium.id/',
            'auth' => ['dev', '123456'],
        ]);
    }

    public function get_product($value, $type = 'id')
    {
        try {
            $response = $this->_client->request('GET', 'product', [
                'query' => [
                    $type => $value,
                ]
            ]);
        } catch (\Throwable $e) {
            return null;
        }

        $result = json_decode($response->getBody()->getContents(), true);

        return $result['products'][0];
    }

    public function get_all_product()
    {
        try {
            $response = $this->_client->request('GET', 'product');
        } catch (\Throwable $e) {
            return null;
        }

        $result = json_decode($response->getBody()->getContents(), true);

        return $result['products'];
    }

    public function create_product($data = array())
    {
        try {
            $response = $this->_client->request('POST', 'product', [
                'json' => $data,
            ]);
        } catch (RequestException $e) {
            return json_decode($e->getResponse()->getBody()->getContents(), true);
        }

        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function delete_product($id)
    {
        try {
            $response = $this->_client->request('DELETE', 'product/' . $id);
        } catch (RequestException $e) {
            return json_decode($e->getResponse()->getBody()->getContents(), true);
        }

        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function get_all_category()
    {
        try {
            $response = $this->_client->request('GET', 'product/category');
        } catch (\Throwable $e) {
            return null;
        }

        $result = json_decode($response->getBody()->getContents(), true);

        return $result['category_product'];
    }
}
