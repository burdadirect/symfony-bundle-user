<?php

namespace HBM\UserBundle\Entity\Traits;

/**
 * @method string toJsonValue($value, bool $associative = false, bool $unique = false, callable $callback = null)
 * @method array fromJsonValue($value, $default = [])
 * @method string|null getPassword()
 */

trait UserPasswordPolicyTrait {

  /****************************************************************************/
  /* PROPERTIES                                                               */
  /****************************************************************************/

  protected ?\DateTime $passwordChanged = null;

  protected ?string $passwordsPreviousJson = '[]';

  /****************************************************************************/
  /* GETTER / SETTER                                                          */
  /****************************************************************************/

  /**
   * Set passwordChanged.
   *
   * @param \DateTime|null $passwordChanged
   *
   * @return self
   */
  public function setPasswordChanged(?\DateTime $passwordChanged): self {
    $this->passwordChanged = $passwordChanged;

    return $this;
  }

  /**
   * Get passwordChanged.
   *
   * @return \DateTime|null
   */
  public function getPasswordChanged(): ?\DateTime {
    return $this->passwordChanged;
  }

  /**
   * Set passwordsPreviousJson.
   *
   * @param string|null $passwordsPreviousJson
   *
   * @return self
   */
  public function setPasswordsPreviousJson(?string $passwordsPreviousJson): self {
    $this->passwordsPreviousJson = $passwordsPreviousJson;

    return $this;
  }

  /**
   * Get passwordsPreviousJson.
   *
   * @return string|null
   */
  public function getPasswordsPreviousJson(): ?string {
    return $this->passwordsPreviousJson;
  }

  /**
   * @param array $passwordsPrevious
   *
   * @return self
   */
  public function setPasswordsPrevious(array $passwordsPrevious): self {
    return $this->setPasswordsPreviousJson($this->toJsonValue($passwordsPrevious));
  }

  /**
   * @return array
   */
  public function getPasswordsPrevious(): array {
    return $this->fromJsonValue($this->getPasswordsPreviousJson());
  }

  /**
   * @param string $passwordPrevious
   *
   * @return self
   */
  public function addPasswordPrevious(string $passwordPrevious, ?int $keep = null): self {
    $passwordsPrevious = $this->getPasswordsPrevious();
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
   * @param int $days
   *
   * @return bool
   *
   * @throws \Exception
   */
  public function shouldPasswordChange(int $days): bool {
    return $this->getPasswordChanged() < new \DateTime('-'.$days.'days');
  }

  /****************************************************************************/

  public function isPasswordReset(): bool {
    return !$this->getPassword();
  }

  public function isPasswordLegacy(): bool {
    return strpos($this->getPassword(), '$') !== 0;
  }

}
