<?php

namespace HBM\UserBundle\Service;

use HBM\UserBundle\Entity\Interfaces\UserPasswordPolicy;
use HBM\UserBundle\Traits\ServiceDependencies\PasswordHasherFactoryDependencyTrait;

class UserPasswordPolicyHelper
{
    use PasswordHasherFactoryDependencyTrait;

    private array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function getNumOfPreviousPasswordsToAvoid(): int
    {
        return $this->config['previous_passwords']['avoid'];
    }

    public function getNumOfPreviousPasswordsToStore(): int
    {
        return $this->config['previous_passwords']['store'];
    }

    public function getNumOfDaysToRequirePasswordChangeLatest(): int
    {
        return $this->config['require_change']['latest'];
    }

    public function getNumOfDaysToRequirePasswordChangeRemind(): int
    {
        return $this->config['require_change']['remind'];
    }

    public function wasPasswordPreviouslyUsed(UserPasswordPolicy $user, string $password, int $num = null): bool
    {
        $passwordHasher = $this->passwordHasherFactory->getPasswordHasher($user);

        $num ??= $this->getNumOfPreviousPasswordsToAvoid();

        $passwordsPreviousData = array_slice($user->getPasswordsPrevious(), -$num);
        foreach ($passwordsPreviousData as $passwordPreviousData) {
            $passwordPrevious = $passwordPreviousData['password'];

            if ($passwordHasher->verify($passwordPrevious, $password)) {
                return true;
            }
        }

        return false;
    }
}
