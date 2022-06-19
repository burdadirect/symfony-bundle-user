<?php

namespace HBM\UserBundle\Traits\ServiceDependencies;

use HBM\UserBundle\Service\UserPasswordPolicyHelper;

trait UserPasswordPolicyHelperDependencyTrait {

  protected UserPasswordPolicyHelper $passwordPolicyHelper;

  /**
   * @required
   *
   * @param UserPasswordPolicyHelper $passwordPolicyHelper
   *
   * @return void
   */
  public function setPasswordPolicyHelper(UserPasswordPolicyHelper $passwordPolicyHelper): void {
    $this->passwordPolicyHelper = $passwordPolicyHelper;
  }

}
