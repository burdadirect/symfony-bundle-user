<?php

namespace HBM\UserBundle\Traits\ServiceDependencies;

use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;

trait PasswordHasherFactoryDependencyTrait {

  protected PasswordHasherFactoryInterface $passwordHasherFactory;

  /**
   * @required
   *
   * @param PasswordHasherFactoryInterface $passwordHasherFactory
   *
   * @return void
   */
  public function setPasswordHasherFactory(PasswordHasherFactoryInterface $passwordHasherFactory): void {
    $this->passwordHasherFactory = $passwordHasherFactory;
  }

}
