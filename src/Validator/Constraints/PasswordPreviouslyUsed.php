<?php

namespace HBM\UserBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

class PasswordPreviouslyUsed extends Constraint
{
    public static string $message = 'Das Passwort wurde zuvor bereits genutzt. Das Passwort sollte sich von den letzten {{ num }} Passwörtern unterscheiden.';

//    #[HasNamedArguments]
    public function __construct(?array $options = null, ?array $groups = null, mixed $payload = null)
    {
        if (\is_array($options)) {
            trigger_deprecation('symfony/validator', '7.3', 'Passing an array of options to configure the "%s" constraint is deprecated, use named arguments instead.', static::class);
        }

        parent::__construct(null, $groups, $payload);
    }


    public function getTargets(): string|array
    {
        return self::CLASS_CONSTRAINT;
    }
}
