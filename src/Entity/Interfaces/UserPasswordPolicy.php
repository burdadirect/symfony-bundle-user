<?php

namespace HBM\UserBundle\Entity\Interfaces;

use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

interface UserPasswordPolicy extends PasswordAuthenticatedUserInterface
{
    /**
     * Get plain passsword.
     */
    public function getPlainPassword(): ?string;

    /**
     * Get password changed.
     */
    public function getPasswordChanged(): ?\DateTime;

    /**
     * Get previous passwords.
     */
    public function getPasswordsPrevious(): array;
}
