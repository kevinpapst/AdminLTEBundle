<?php

/*
 * This file is part of the AdminLTE bundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KevinPapst\AdminLTEBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * Loads AdminLTEBundle configuration
 *
 * @see http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class AdminLTEExtension extends Extension implements PrependExtensionInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        $options = $this->getContextOptions($config);

        if (!empty($config)) {
            $container->setParameter('admin_lte_theme.options', $options);
        }

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');

        if ($options['knp_menu']['enable'] === true) {
            $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config/container'));
            $loader->load('knp-menu.yml');
        }
    }

    /**
     * Merge available configuration options, so they are all available for the ContextHelper.
     *
     * @param array $config
     * @return array
     */
    protected function getContextOptions(array $config = [])
    {
        $sidebar = [];

        if (isset($config['control_sidebar']) && !empty($config['control_sidebar'])) {
            $sidebar = $config['control_sidebar'];
        }

        $contextOptions = (array) ($config['options'] ?? []);
        $contextOptions['control_sidebar'] = $sidebar;
        $contextOptions['knp_menu'] = (array) $config['knp_menu'];
        $contextOptions = array_merge($contextOptions, $config['theme']);

        return $contextOptions;
    }

    /**
     * @see https://symfony.com/doc/current/bundles/prepend_extension.html
     *
     * @param ContainerBuilder $container
     */
    public function prepend(ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $configs = $container->getExtensionConfig($this->getAlias());
        $config = $this->processConfiguration($configuration, $configs);

        $options = (array) ($config['options'] ?? []);
        $routes = (array) ($config['routes'] ?? []);

        $container->setParameter('admin_lte_theme.options', $options);
        $container->setParameter('admin_lte_theme.routes', $routes);

        if (!array_key_exists('form_theme', $options) || null === ($theme = $options['form_theme'])) {
            return;
        }

        $themes = [
            'default' => '@AdminLTE/layout/form-theme.html.twig',
            'horizontal' => '@AdminLTE/layout/form-theme-horizontal.html.twig',
        ];

        if (!array_key_exists($theme, $themes)) {
            return;
        }

        $bundles = $container->getParameter('kernel.bundles');

        // register the form theme
        if (isset($bundles['TwigBundle'])) {
            $container->prependExtensionConfig('twig', ['form_theme' => [$themes[$theme]]]);
        }
    }
}
