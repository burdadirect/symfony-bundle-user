<?php

namespace HBM\UserBundle\Entity\Traits;

/**
 * @method string      toJsonValue($value, bool $associative = false, bool $unique = false, callable $callback = null)
 * @method array       fromJsonValue($value, $default = [])
 * @method null|string getPassword()
 */
trait UserPasswordPolicyTrait
{
    /* PROPERTIES */

    protected ?\DateTime $passwordChanged = null;

    protected ?string $passwordsPreviousJson = '[]';

    /* GETTER / SETTER */

    /**
     * Set passwordChanged.
     */
    public function setPasswordChanged(?\DateTime $passwordChanged): self
    {
        $this->passwordChanged = $passwordChanged;

        return $this;
    }

    /**
     * Get passwordChanged.
     */
    public function getPasswordChanged(): ?\DateTime
    {
        return $this->passwordChanged;
    }

    /**
     * Set passwordsPreviousJson.
     */
    public function setPasswordsPreviousJson(?string $passwordsPreviousJson): self
    {
        $this->passwordsPreviousJson = $passwordsPreviousJson;

        return $this;
    }

    /**
     * Get passwordsPreviousJson.
     */
    public function getPasswordsPreviousJson(): ?string
    {
        return $this->passwordsPreviousJson;
    }

    public function setPasswordsPrevious(array $passwordsPrevious): self
    {
        return $this->setPasswordsPreviousJson($this->toJsonValue($passwordsPrevious));
    }

    public function getPasswordsPrevious(): array
    {
        return $this->fromJsonValue($this->getPasswordsPreviousJson());
    }

    public function addPasswordPrevious(string $passwordPrevious, int $keep = null): self
    {
        $passwordsPrevious   = $this->getPasswordsPrevious();
        $passwordsPrevious[] = [
          'password' => $passwordPrevious,
          'datetime' => date('Y-m-d H:i:s'),
        ];

        // Only keep the last x password hashes.
        if ($keep !== null) {
            $passwordsPrevious = array_slice($passwordsPrevious, -$keep);
        }

        return $this->setPasswordsPrevious($passwordsPrevious);
    }

    /**
     * @throws \Exception
     */
    public function shouldPasswordChange(int $days): bool
    {
        return $this->getPasswordChanged() < new \DateTime('-' . $days . 'days');
    }

    public function isPasswordReset(): bool
    {
        return !$this->getPassword();
    }

    public function isPasswordLegacy(): bool
    {
        return strpos($this->getPassword(), '$') !== 0;
    }

    /**
     * @throws \Exception
     */
    public function getStatePassword(int $daysExpire, int $daysRemind): string
    {
        if ($this->isPasswordReset()) {
            return 'reset';
        }

        if ($this->isPasswordLegacy()) {
            return 'legacy';
        }

        if ($this->shouldPasswordChange($daysExpire)) {
            return 'expired';
        }

        if ($this->shouldPasswordChange($daysRemind)) {
            return 'about to expire';
        }

        return 'ok';
    }
}
