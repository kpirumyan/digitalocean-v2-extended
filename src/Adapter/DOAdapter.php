<?php

namespace DigitalOceanV2Extended\Adapter;

use DigitalOceanV2\Adapter\GuzzleHttpAdapter;
use Drupal\digital_ocean_api\Encryption\Encryptor;
use Drupal\encrypt\Entity\EncryptionProfile;

class DOAdapter extends GuzzleHttpAdapter
{

  /**
   * DOAdapter constructor.
   */
  public function __construct() {
    parent::__construct($this->getToken());
  }

  /**
   * Gets decrypted user DO token.
   *
   * @return string
   */
  private function getToken() {
    $encryption_profile = EncryptionProfile::load('digital_ocean_encryption_profile');

    if (!$encryption_profile) {
      \Drupal::messenger()->addError('Encryption profile is not set');
      return '';
    }

    $user = \Drupal::routeMatch()->getParameter('user');
    $token = $user->get('field_do_token')->value;

    return Encryptor::decryptToken($token, $encryption_profile);
  }
}