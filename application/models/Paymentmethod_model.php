
<?php
defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class Paymentmethod_model extends CI_Model
{
    private $_client;

    public function __construct()
    {
        $this->_client = new Client([
            'base_uri' => 'http://api.thriftporium.id',
            'auth' => ['dev', '123456'],
        ]);
    }

    public function get_all_method()
    {
        try {
            $response = $this->_client->request('GET', 'payment/account');
        } catch (\Throwable $e) {
            return null;
        }

        $result = json_decode($response->getBody()->getContents(), true);

        return $result['data'];
    }
}
