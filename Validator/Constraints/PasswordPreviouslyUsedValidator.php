<?php

namespace HBM\UserBundle\Validator\Constraints;

use HBM\UserBundle\Entity\Interfaces\UserPasswordPolicy;
use HBM\UserBundle\Traits\ServiceDependencies\UserPasswordPolicyHelperDependencyTrait;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class PasswordPreviouslyUsedValidator extends ConstraintValidator {

  use UserPasswordPolicyHelperDependencyTrait;

  /**
   * @param mixed $value
   * @param Constraint $constraint
   *
   * @return bool|null
   */
  public function validate($value, Constraint $constraint): ?bool {
    if (!$constraint instanceof PasswordPreviouslyUsed) {
      throw new UnexpectedTypeException($constraint, PasswordPreviouslyUsed::class);
    }

    if (!$value instanceof UserPasswordPolicy) {
      throw new \LogicException('Object should be of type '.UserPasswordPolicy::class.'.');
    }

    if (!$value->getPlainPassword()) {
      return null;
    }

    if ($this->userPasswordPolicyHelper->wasPasswordPreviouslyUsed($value, $value->getPlainPassword())) {
      $this->context->buildViolation(PasswordPreviouslyUsed::$message)
        ->atPath('plainPassword')
        ->setParameter('{{ num }}', $this->userPasswordPolicyHelper->getNumOfPreviousPasswordsToAvoid())
        ->addViolation();

      return false;
    }

    return true;
  }

}
