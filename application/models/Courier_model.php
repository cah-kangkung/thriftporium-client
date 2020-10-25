<?php
defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class Courier_model extends CI_Model
{
    private $_client;

    public function __construct()
    {
        $this->_client = new Client([
            'base_uri' => 'http://api.thriftporium.id',
            'auth' => ['dev', '123456'],
        ]);
    }

    public function get_courier($value, $type = 'id')
    {
        try {
            $response = $this->_client->request('GET', 'courier', [
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
}
