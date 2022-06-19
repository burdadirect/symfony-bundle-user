# HBM User Bundle

## Team

### Developers
- Christian Puchinger - christian.puchinger@burda.com

## Installation

### Step 1: Download the Bundle

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```bash
$ composer require burdadirect/symfony-bundle-user
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

### Step 2: Enable the Bundle

With Symfony 4/5 the bundle is enabled automatically for all environments (see `config/bundles.php`). 


### Step 3: Configuration

```yml
hbm_user:
    password_policy:
        previous_passwords:
            store: 10
            avoid: 5
        require_change:
            latest: 180
            remind: 170

```

## Usage

Implement the `UserPasswordPolicy` interface (use the `UserPasswordPolicyTrait`) for the user entity.

Add the `PasswordPreviouslyUsed` validator to the password change forms.

Use the `PasswordExpiredException` in the `UserChecker`.

