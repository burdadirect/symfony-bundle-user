<?php

namespace HBM\UserBundle\Traits\ServiceDependencies;

use HBM\UserBundle\Service\UserPasswordPolicyHelper;

trait UserPasswordPolicyHelperDependencyTrait {

  protected UserPasswordPolicyHelper $userPasswordPolicyHelper;

  /**
   * @required
   *
   * @param UserPasswordPolicyHelper $userPasswordPolicyHelper
   *
   * @return void
   */
  public function setUserPasswordPolicyHelper(UserPasswordPolicyHelper $userPasswordPolicyHelper): void {
    $this->userPasswordPolicyHelper = $userPasswordPolicyHelper;
  }

}
