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
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
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
            echo '[AdminLTE] invalid theme config, bundle config was skipped: ' . $e->getMessage();
            $config = [];
        }

        // Use the config only if it is fully validated from the processed configuration
        if (!empty($config)) {
            $container->setParameter('admin_lte_theme.options', (array) ($config['options'] ?? []));
        }

        // Load the services (with parameters loaded)
        try {
            $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
            $loader->load('services.yml');
        } catch (\Exception $e) {
            echo '[AdminLTE] invalid services config found: ' . $e->getMessage();
        }
    }

    /**
     * Allow an extension to prepend the extension configurations.
     *
     * @see https://symfony.com/doc/current/bundles/prepend_extension.html
     *
     * @param ContainerBuilder $container
     */
    public function prepend(ContainerBuilder $container)
    {
        $baseConfiguration = new Configuration();

        // Load the configuration from files

        // The configuration of our ThemeExtension
        $configs = $container->getExtensionConfig($this->getAlias());

        try {
            // use the Configuration class to generate a config array with the config extension
            $config = $this->processConfiguration($baseConfiguration, $configs);
        } catch (InvalidConfigurationException $e) {
            // Fallback: ignore invalid config from the container user config file and abort use configuration in prepend
            echo 'AdminLTE: invalid config (prepend): ' . $e->getMessage() . PHP_EOL . '    The config options for the bundle were skipped' . PHP_EOL;
            $config = [];
        }

        // Create the parameter for the service (dependency with admin_lte_theme.extension.class) even if empty config
        $container->setParameter('admin_lte_theme.options', (array) ($config['options'] ?? []));
        // Create the parameter for the service (dependency with admin_lte_theme.extension.class) even if empty config
        $container->setParameter('admin_lte_theme.routes', (array) ($config['routes'] ?? []));

        // Use the config only if it is fully validated from the processed configuration
        if (!empty($config)) {
            // Get all the bundles
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
