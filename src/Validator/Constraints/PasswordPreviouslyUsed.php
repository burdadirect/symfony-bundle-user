<?php

namespace HBM\UserBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

class PasswordPreviouslyUsed extends Constraint {

  public static string $message = 'Das Passwort wurde zuvor bereits genutzt. Das Passwort sollte sich von den letzten {{ num }} Passwörtern unterscheiden.';

  public function getTargets(): string|array {
    return self::CLASS_CONSTRAINT;
  }

}
