<?php

/*
 * This file is part of the AdminLTE bundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AdminLTEBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Symfony\Component\Config\Exception\FileLocatorFileNotFoundException;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\OptionsResolver\Exception\InvalidArgumentException;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class ThemeExtension extends Extension implements PrependExtensionInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $baseConfiguration = new Configuration();

        // Load the configuration from files
        try {
            $config = $this->processConfiguration($baseConfiguration, $configs);
        } catch (InvalidConfigurationException $e) {
            // Fallback: ignore invalid config from the container user config file and abort use configuration in load
            echo 'AvanzuAdminBundle: invalid config (load): ' . $e->getMessage() . PHP_EOL . '    The config options for the bundle AvanzuAdminBundle were skipped' . PHP_EOL;
            $config = [];
        }

        // Use the config only if it is fully validated from the processed configuration
        if (!empty($config)) {
            // Set the parameters from config files
            $container->setParameter('admin_lte_theme.options', (array) ($config['options'] ?? []));
        }

        // Load the services (with parameters loaded), since twig require theme_manager service
        try {
            $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
            $loader->load('services.xml');
        } catch (FileLocatorFileNotFoundException $e) { // Symfony 3.3 and 4.x are based in YAML
            $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
            $loader->load('services.yml');
        } catch (InvalidArgumentException $e) { // Symfony 3.3 and 4.x are based in YAML
            $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
            $loader->load('services.yml');
        } catch (\Exception $e) { // Symfony 3.3 and 4.x are based in YAML
            $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
            $loader->load('services.yml');
            // echo 'AvanzuAdminTheme: ' . $e->getMessage() . PHP_EOL; // Use this for your own debugging
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
            echo 'AvanzuAdminBundle: invalid config (prepend): ' . $e->getMessage() . PHP_EOL . '    The config options for the bundle AvanzuAdminBundle were skipped' . PHP_EOL;
            $config = [];
        }

        // Create the parameter for the service (dependency with admin_lte_theme.extension.class) even if empty config
        $container->setParameter('admin_lte_theme.options', (array) ($config['options'] ?? []));

        // Use the config only if it is fully validated from the processed configuration
        if (!empty($config)) {
            // Get all the bundles
            $bundles = $container->getParameter('kernel.bundles');

            // Inject in twig global config the theme_manager service
            if (isset($bundles['TwigBundle'])) {
                $container->prependExtensionConfig(
                    'twig',
                    [
                        'form_theme' => [
                            '@AvanzuAdminTheme/layout/form-theme.html.twig',
                        ],
                        'globals' => [
                            'admin_theme' => '@admin_lte_theme.theme_manager',
                        ],
                    ]
                );
            }
        }
    }
}
