<?php

namespace HBM\UserBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface {

  /**
   * {@inheritdoc}
   */
  public function getConfigTreeBuilder(): TreeBuilder {
    $treeBuilder = new TreeBuilder('hbm_user');
    $rootNode = $treeBuilder->getRootNode();

    $rootNode
      ->children()
        ->arrayNode('password_policy')->info('Password policy configuration.')->addDefaultsIfNotSet()
          ->children()
            ->arrayNode('previous_passwords')->addDefaultsIfNotSet()
              ->children()
                ->scalarNode('store')->defaultValue(10)->info('The number of previous passwords to save.')->end()
                ->scalarNode('avoid')->defaultValue(5)->info('The number of previous passwords to avoid when choosing a new password.')->end()
              ->end()
            ->end()
            ->arrayNode('require_change')->addDefaultsIfNotSet()
              ->children()
                ->scalarNode('latest')->defaultValue(180)->info('The number of days a password stays valid.')->end()
                ->scalarNode('remind')->defaultValue(170)->info('The number of days the user is reminded after the last password change.')->end()
              ->end()
            ->end()
          ->end()
        ->end()
      ->end();

    return $treeBuilder;
  }

}
