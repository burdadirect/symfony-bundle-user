<?php

namespace HBM\UserBundle\Traits\ServiceDependencies;

use HBM\UserBundle\Service\UserPasswordPolicyHelper;
use Symfony\Contracts\Service\Attribute\Required;

trait UserPasswordPolicyHelperDependencyTrait {

  protected UserPasswordPolicyHelper $userPasswordPolicyHelper;

  /**
   * @param UserPasswordPolicyHelper $userPasswordPolicyHelper
   *
   * @return void
   */
  #[Required]
  public function setUserPasswordPolicyHelper(UserPasswordPolicyHelper $userPasswordPolicyHelper): void {
    $this->userPasswordPolicyHelper = $userPasswordPolicyHelper;
  }

}
