<?php

/*
 * This file is part of the AdminLTE bundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KevinPapst\AdminLTEBundle\Tests\DependencyInjection;

use KevinPapst\AdminLTEBundle\DependencyInjection\Configuration;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\Definition\Processor;

class ConfigurationTest extends TestCase
{
    public function testDefaultConfiguration()
    {
        $configuration = new Configuration();
        $processor = new Processor();
        $node = $configuration->getConfigTreeBuilder()->buildTree();

        $config = ['admin_lte' => []];
        $processedConfig = $processor->process($node, $config);

        $expected = $this->getDefaultConfig()['admin_lte'];
        $expected['control_sidebar'] = [];

        $this->assertEquals($expected, $processedConfig);
    }

    public function testFullConfiguration()
    {
        $configuration = new Configuration();
        $processor = new Processor();
        $node = $configuration->getConfigTreeBuilder()->buildTree();

        $config = $this->getDefaultConfig();
        $processedConfig = $processor->process($node, $config);

        $this->assertEquals($config['admin_lte'], $processedConfig);
    }

    protected function getDefaultConfig()
    {
        return [
            'admin_lte' => [
                'options' => [
                    'default_avatar' => 'bundles/adminlte/images/default_avatar.png',
                    'skin' => 'skin-blue',
                    'fixed_layout' => false,
                    'boxed_layout' => false,
                    'collapsed_sidebar' => false,
                    'mini_sidebar' => false,
                    'max_navbar_notifications' => 10,
                    'max_navbar_tasks' => 10,
                    'max_navbar_messages' => 10,
                    'form_theme' => 'default'
                ],
                'control_sidebar' => [
                    'home' => [
                        'icon' => 'fas fa-home',
                        'template' => 'control-sidebar/home.html.twig',
                    ],
                    'settings' => [
                        'icon' => 'fas fa-cogs',
                        'controller' => 'App\Controller\DefaultController::controlSidebarSettings',
                    ],
                ],
                'theme' => [
                    'widget' => [
                        'type' => 'primary',
                        'bordered' => true,
                        'collapsible' => false,
                        'collapsible_title' => 'Collapse',
                        'removable' => false,
                        'removable_title' => 'Remove',
                        'solid' => false,
                        'use_footer' => true,
                    ],
                    'button' => [
                        'type' => 'primary',
                        'size' => false,
                    ],
                ],
                'knp_menu' => [
                    'enable' => false,
                    'main_menu' => 'adminlte_main',
                    'breadcrumb_menu' => false,
                ],
                'routes' => [
                    'adminlte_welcome' => 'home',
                    'adminlte_login' => 'login',
                    'adminlte_login_check' => 'login_check',
                    'adminlte_registration' => null,
                    'adminlte_password_reset' => null,
                    'adminlte_message' => 'message',
                    'adminlte_messages' => 'messages',
                    'adminlte_notification' => 'notification',
                    'adminlte_notifications' => 'notifications',
                    'adminlte_task' => 'task',
                    'adminlte_tasks' => 'tasks',
                    'adminlte_profile' => 'profile',
                ],
            ]
        ];
    }
}
