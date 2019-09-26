<?php

namespace DigitalOceanV2Extended;

use DigitalOceanV2\DigitalOceanV2;

class DigitalOceanV2Extended extends DigitalOceanV2 {

  /**
   * @return Database
   */
  public function account()
  {
    return new Database($this->adapter);
  }
}