<?php

namespace HBM\UserBundle\Service;

use HBM\UserBundle\Entity\Interfaces\UserPasswordPolicy;
use HBM\UserBundle\Traits\ServiceDependencies\PasswordHasherFactoryDependencyTrait;

class UserPasswordPolicyHelper {

  use PasswordHasherFactoryDependencyTrait;

  private array $config;

  /**
   * @param array $config
   */
  public function __construct(array $config) {
    $this->config = $config;
  }

  /**
   * @return int
   */
  public function getNumOfPreviousPasswordsToAvoid(): int {
    return $this->config['previous_passwords']['avoid'];
  }

  /**
   * @return int
   */
  public function getNumOfPreviousPasswordsToStore(): int {
    return $this->config['previous_passwords']['store'];
  }

  /**
   * @param UserPasswordPolicy $user
   * @param string $password
   * @param int $num
   *
   * @return bool
   */
  public function wasPasswordPreviouslyUsed(UserPasswordPolicy $user, string $password, ?int $num = null): bool {
    $passwordHasher = $this->passwordHasherFactory->getPasswordHasher($user);

    $num = $num ?? $this->getNumOfPreviousPasswordsToAvoid();

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
