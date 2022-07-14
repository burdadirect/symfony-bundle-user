<?php

namespace HBM\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class HBMUserBundle extends Bundle {

  public function getPath(): string {
    return \dirname(__DIR__);
  }

}
