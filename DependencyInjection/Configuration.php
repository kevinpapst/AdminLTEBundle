<?php

/*
 * This file is part of the AdminLTE bundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KevinPapst\AdminLTEBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\NodeBuilder;
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

        $rootNodeChildren = $rootNode->children();
        $rootNodeChildren = $this->createSimpleChildren($rootNodeChildren, true);
        $rootNodeChildren = $this->createThemeChildren($rootNodeChildren);
        $rootNodeChildren = $this->createButtonChildren($rootNodeChildren);
        $rootNodeChildren = $this->createRouteAlias($rootNodeChildren);

        $rootNodeChildren->end();

        return $treeBuilder;
    }

    private function createRouteAlias(NodeBuilder $rootNodeChildren)
    {
        $rootNodeChildren
            ->arrayNode('routes')
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
                    ->defaultValue('login')
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
            ->end();

        return $rootNodeChildren;
    }

    private function createWidgetTree(NodeBuilder $rootNodeChildren)
    {
        $rootNodeChildren
            ->arrayNode('widget')
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
                        ->defaultTrue()
                        ->info('')
                    ->end()
                    ->booleanNode('use_footer')
                        ->defaultFalse()
                        ->info('')
                    ->end()
            ->end();

        return $rootNodeChildren;
    }

    private function createButtonChildren(NodeBuilder $rootNodeChildren)
    {
        $rootNodeChildren
            ->arrayNode('button')
                ->children()
                    ->scalarNode('type')
                        ->defaultValue('primary')
                        ->info('')
                    ->end()
                    ->scalarNode('size')
                        ->defaultFalse()
                        ->info('')
                    ->end()
                ->end()
            ->end();

        return $rootNodeChildren;
    }

    private function createSimpleChildren(NodeBuilder $rootNodeChildren, $withOptions = true)
    {
        if ($withOptions) {
            $optionChildren = $rootNodeChildren
                ->arrayNode('options')
                     ->info('')
                     ->children();

            $optionChildren = $this->createSimpleChildren($optionChildren, false);
            $optionChildren = $this->createWidgetTree($optionChildren);
            $optionChildren = $this->createButtonChildren($optionChildren);
            $optionChildren = $this->createsubThemeChildren($optionChildren);

            $optionChildren->end();
        }

        $rootNodeChildren
            ->arrayNode('knp_menu')
                ->children()
                    ->scalarNode('enable')
                        ->defaultValue(false)
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

        return $rootNodeChildren;
    }

    private function createThemeChildren(NodeBuilder $rootNodeChildren)
    {
        $themeChildren = $rootNodeChildren->arrayNode('theme')->children();

        $themeChildren = $this->createWidgetTree($themeChildren);
        $themeChildren = $this->createsubThemeChildren($themeChildren);
        $themeChildren->end()
            ->end();

        return $rootNodeChildren;
    }

    private function createsubThemeChildren(NodeBuilder $rootNodeChildren)
    {
        $rootNodeChildren
            ->scalarNode('default_avatar')
                ->defaultValue('bundles/adminlte/default_avatar.png')
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
            ->arrayNode('control_sidebar')
                ->arrayPrototype()
                    ->children()
                        ->scalarNode('icon')->end()
                        ->scalarNode('controller')->end()
                        ->scalarNode('template')->end()
                    ->end()
                ->end()
                ->info('controls all panels in the right control_sidebar')
            ->end();

        return $rootNodeChildren;
    }
}
