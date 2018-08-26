<?php

/*
 * This file is part of the AdminLTE bundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KevinPapst\AdminLTEBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges the AdminLTEBundle configuration
 *
 * @see http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('admin_lte');

        $rootNode
            ->children()
                ->append($this->getOptionsConfig())
                ->append($this->getControlSidebarConfig())
                ->append($this->getThemeConfig())
                ->append($this->getKnpMenuConfig())
                ->append($this->getRouteAliasesConfig())
            ->end()
        ->end();

        return $treeBuilder;
    }

    private function getRouteAliasesConfig()
    {
        $builder = new TreeBuilder();
        $node = $builder->root('routes');

        $node
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('adminlte_welcome')
                    ->defaultValue('home')
                    ->info('name of the homepage route')
                ->end()
                ->scalarNode('adminlte_login')
                    ->defaultValue('login')
                    ->info('name of the form login route')
                ->end()
                ->scalarNode('adminlte_login_check')
                    ->defaultValue('login_check')
                    ->info('name of the form login_check route')
                ->end()
                ->scalarNode('adminlte_registration')
                    ->defaultNull()
                    ->info('name of the user registration form route')
                ->end()
                ->scalarNode('adminlte_password_reset')
                    ->defaultNull()
                    ->info('name of the forgot-password form route')
                ->end()
                ->scalarNode('adminlte_message')
                    ->defaultValue('message')
                    ->info('name of the route to one message')
                ->end()
                ->scalarNode('adminlte_messages')
                    ->defaultValue('messages')
                    ->info('name of the route to all messages')
                ->end()
                ->scalarNode('adminlte_notification')
                    ->defaultValue('notification')
                    ->info('name of the route to one notification')
                ->end()
                ->scalarNode('adminlte_notifications')
                    ->defaultValue('notifications')
                    ->info('name of the route to all notification')
                ->end()
                ->scalarNode('adminlte_task')
                    ->defaultValue('task')
                    ->info('name of the route to one task')
                ->end()
                ->scalarNode('adminlte_tasks')
                    ->defaultValue('tasks')
                    ->info('name of the route to all tasks')
                ->end()
                ->scalarNode('adminlte_profile')
                    ->defaultValue('profile')
                    ->info('name of the route to the users profile')
                ->end()
            ->end()
        ->end();

        return $node;
    }

    private function getKnpMenuConfig()
    {
        $builder = new TreeBuilder();
        $node = $builder->root('knp_menu');

        $node
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('enable')
                    ->defaultFalse()
                    ->info('')
                ->end()
                ->scalarNode('main_menu')
                    ->defaultValue('adminlte_main')
                    ->info('your builder alias')
                ->end()
                ->scalarNode('breadcrumb_menu')
                    ->defaultFalse()
                    ->info('Your builder alias or false to disable breadcrumbs')
                ->end()
            ->end()
        ->end();

        return $node;
    }

    private function getWidgetConfig()
    {
        $builder = new TreeBuilder();
        $node = $builder->root('widget');

        $node
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('collapsible_title')
                    ->defaultValue('Collapse')
                    ->info('')
                ->end()
                ->scalarNode('removable_title')
                    ->defaultValue('Remove')
                    ->info('')
                ->end()
                ->scalarNode('type')
                    ->defaultValue('primary')
                    ->info('')
                ->end()
                    ->booleanNode('bordered')
                    ->defaultTrue()
                    ->info('')
                ->end()
                    ->booleanNode('collapsible')
                    ->defaultFalse()
                    ->info('')
                ->end()
                ->booleanNode('removable')
                    ->defaultFalse()
                    ->info('')
                ->end()
                ->booleanNode('solid')
                    ->defaultFalse()
                    ->info('')
                ->end()
                ->booleanNode('use_footer')
                    ->defaultTrue()
                    ->info('')
                ->end()
            ->end()
        ->end();

        return $node;
    }

    private function getButtonConfig()
    {
        $builder = new TreeBuilder();
        $node = $builder->root('button');

        $node
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('type')
                    ->defaultValue('primary')
                    ->info('default button type')
                ->end()
                ->scalarNode('size')
                    ->defaultFalse()
                    ->info('default button size')
                ->end()
            ->end()
        ->end();

        return $node;
    }

    private function getThemeConfig()
    {
        $builder = new TreeBuilder();
        $node = $builder->root('theme');

        $node
            ->addDefaultsIfNotSet()
            ->children()
                ->append($this->getWidgetConfig())
                ->append($this->getButtonConfig())
            ->end()
        ->end();

        return $node;
    }

    private function getOptionsConfig()
    {
        $builder = new TreeBuilder();
        $node = $builder->root('options');

        $node
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('default_avatar')
                    ->defaultValue('bundles/adminlte/images/default_avatar.png')
                ->end()
                ->scalarNode('skin')
                    ->defaultValue('skin-blue')
                    ->info('see skin listing for viable options')
                ->end()
                ->booleanNode('fixed_layout')
                    ->defaultFalse()
                ->end()
                ->booleanNode('boxed_layout')
                    ->defaultFalse()
                    ->info('these settings relate directly to the "Layout Options"')
                ->end()
                ->booleanNode('collapsed_sidebar')
                    ->defaultFalse()
                    ->info('described in the documentation')
                ->end()
                ->booleanNode('mini_sidebar')
                    ->defaultFalse()
                    ->info('')
                ->end()
                // this is deprecated, but still supported until 3.0
                ->append($this->getControlSidebarConfig())
            ->end()
        ->end();

        return $node;
    }

    private function getControlSidebarConfig()
    {
        $builder = new TreeBuilder();
        $node = $builder->root('control_sidebar');

        $node
            ->arrayPrototype()
                ->children()
                    ->scalarNode('icon')->end()
                    ->scalarNode('controller')->end()
                    ->scalarNode('template')->end()
                ->end()
            ->end()
            ->info('controls all panels in the right control_sidebar')
        ->end();

        return $node;
    }
}
