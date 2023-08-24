<?php

namespace HBM\UserBundle\Traits\ServiceDependencies;

use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;
use Symfony\Contracts\Service\Attribute\Required;

trait PasswordHasherFactoryDependencyTrait {

  protected PasswordHasherFactoryInterface $passwordHasherFactory;

  /**
   * @param PasswordHasherFactoryInterface $passwordHasherFactory
   *
   * @return void
   */
  #[Required]
  public function setPasswordHasherFactory(PasswordHasherFactoryInterface $passwordHasherFactory): void {
    $this->passwordHasherFactory = $passwordHasherFactory;
  }

}
