<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
|  Google API Configuration
| -------------------------------------------------------------------
| 
| To get API details you have to create a Google Project
| at Google API Console (https://console.developers.google.com)
| 
|  client_id         string   Your Google API Client ID.
|  client_secret     string   Your Google API Client secret.
|  redirect_uri      string   URL to redirect back to after login.
|  application_name  string   Your Google application name.
|  api_key           string   Developer key.
|  scopes            string   Specify scopes
*/

$config['googleplus']['client_id']        = '930770229720-0c5irk0ehimms9qrl2rio73cregi822d.apps.googleusercontent.com';
$config['googleplus']['client_secret']    = 'qCSaeLuqTDX0pecMD3L8Gn8x';
$config['googleplus']['redirect_uri']     = 'http://localhost/thrift/auth/google';
$config['googleplus']['application_name'] = 'thriftporium.id';
$config['googleplus']['api_key']          = '';
$config['googleplus']['scopes']           = array("email", "profile");
