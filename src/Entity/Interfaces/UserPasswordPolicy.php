<?php

namespace HBM\UserBundle\Entity\Interfaces;

use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

interface UserPasswordPolicy extends PasswordAuthenticatedUserInterface {

  /**
   * Get plain passsword.
   *
   * @return string|null
   */
  public function getPlainPassword(): ?string;


  /**
   * Get password changed.
   *
   * @return \DateTime|null
   */
  public function getPasswordChanged(): ?\DateTime;

  /**
   * Get previous passwords.
   *
   * @return array
   */
  public function getPasswordsPrevious(): array;

}
