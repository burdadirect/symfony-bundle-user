<?php

namespace HBM\UserBundle\Service;

use HBM\UserBundle\Entity\Interfaces\UserPasswordPolicy;

class UserPasswordPolicyHelper {

  use \HBM\UserBundle\Traits\ServiceDependencies\PasswordHasherFactoryDependencyTrait;

  public function wasPasswordPreviouslyUsed(UserPasswordPolicy $user, string $password, int $num = 5): bool {
    $passwordHasher = $this->passwordHasherFactory->getPasswordHasher($user);

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
