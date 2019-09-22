<?php

/*
 * This file is part of the AdminLTE bundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KevinPapst\AdminLTEBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
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
        $baseConfiguration = new Configuration();

        try {
            $config = $this->processConfiguration($baseConfiguration, $configs);
        } catch (InvalidConfigurationException $e) {
            // Fallback: ignore invalid config from the container user config file and abort use configuration in load
            echo '[AdminLTEBundle] invalid theme config, bundle config was skipped: ' . $e->getMessage();
            $config = [];
        }

        $options = $this->getContextOptions($config);

        // Use the config only if it is fully validated from the processed configuration
        if (!empty($config)) {
            $container->setParameter('admin_lte_theme.options', $options);
        }

        // Load the services (with parameters loaded)
        try {
            $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
            $loader->load('services.yml');
        } catch (\Exception $e) {
            echo '[AdminLTEBundle] invalid services config found: ' . $e->getMessage();
        }

        if ($options['knp_menu']['enable'] === true) {
            try {
                $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config/container'));
                $loader->load('knp-menu.yml');
            } catch (\Exception $e) {
                echo '[AdminLTEBundle] failed loading KNP menu service: ' . $e->getMessage();
            }
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
        $baseConfiguration = new Configuration();
        $configs = $container->getExtensionConfig($this->getAlias());

        try {
            $config = $this->processConfiguration($baseConfiguration, $configs);
        } catch (InvalidConfigurationException $e) {
            // Fallback: ignore invalid config from the container user config file and abort prepend
            echo '[AdminLTEBundle] invalid config (prepend), config options for the bundle were skipped: ' . $e->getMessage();
            $config = [];
        }

        // Create the parameter for the service (dependency with admin_lte_theme.extension.class) even if empty config
        $container->setParameter('admin_lte_theme.options', (array) ($config['options'] ?? []));
        // Create the parameter for the service (dependency with admin_lte_theme.extension.class) even if empty config
        $container->setParameter('admin_lte_theme.routes', (array) ($config['routes'] ?? []));

        // Use the config only if it is fully validated from the processed configuration
        if (!empty($config)) {
            $bundles = $container->getParameter('kernel.bundles');

            if (isset($bundles['TwigBundle'])) {
                $container->prependExtensionConfig(
                    'twig',
                    [
                        'form_theme' => [
                            '@AdminLTE/layout/form-theme.html.twig',
                        ],
                    ]
                );
            }
        }
    }
}
