<?php
class FBSignedRequest {

  private $facebook_app_id;
  private $facebook_secret;

  public function __construct() {
    $this->facebook_app_id = '441124352630265';
    $this->facebook_secret = 'dc506a591e46e236b50f1ac2146868ee';
  }

  function parse_signed_request($signed_request) {
    list($encoded_sig, $payload) = explode('.', $signed_request, 2); 

    // decode the data
    $sig = $this->base64_url_decode($encoded_sig);
    $data = json_decode($this->base64_url_decode($payload), true);

    if (strtoupper($data['algorithm']) !== 'HMAC-SHA256') {
      error_log('Unknown algorithm. Expected HMAC-SHA256');
      return null;
    }

    // check sig
    $expected_sig = hash_hmac('sha256', $payload, $this->facebook_secret, $raw = true);
    if ($sig !== $expected_sig) {
      error_log('Bad Signed JSON signature!');
      return null;
    }

    return $data;
  }

  function base64_url_decode($input) {
      return base64_decode(strtr($input, '-_', '+/'));
  }
}
?>