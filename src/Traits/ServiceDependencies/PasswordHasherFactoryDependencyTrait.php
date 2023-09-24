<?php

namespace HBM\UserBundle\Traits\ServiceDependencies;

use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;
use Symfony\Contracts\Service\Attribute\Required;

trait PasswordHasherFactoryDependencyTrait
{
    protected PasswordHasherFactoryInterface $passwordHasherFactory;

    #[Required]
    public function setPasswordHasherFactory(PasswordHasherFactoryInterface $passwordHasherFactory): void
    {
        $this->passwordHasherFactory = $passwordHasherFactory;
    }
}
