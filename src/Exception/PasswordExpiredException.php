<?php

namespace HBM\UserBundle\Exception;

use Symfony\Component\Security\Core\Exception\CustomUserMessageAccountStatusException;

class PasswordExpiredException extends CustomUserMessageAccountStatusException {

}
