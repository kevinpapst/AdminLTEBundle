<?php

/*
 * This file is part of the AdminLTE bundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AdminLTEBundle\Helper;

use AdminLTEBundle\Routing\RouteAliasCollection;
use Symfony\Component\OptionsResolver\Exception\UndefinedOptionsException;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContextHelper extends \ArrayObject
{
    /**
     * @var RouteAliasCollection
     */
    private $router;

    /**
     * ContextHelper constructor.
     *
     * @param array $config The data under admin_lte_theme.options config
     * @param RouteAliasCollection $router admin_lte_theme.admin_route class route service
     */
    public function __construct(array $config, RouteAliasCollection $router)
    {
        $this->initialize($config);
        $this->router = $router;
    }

    /**
     * Create a OptionResolver with default parameters and overwrite the context
     * with the default options in admin_lte_theme.options
     *
     * @param array $config The data under admin_lte_theme.options config
     */
    protected function initialize(array $config = [])
    {
        // Create a resolve and configure the defaults
        $resolver = new OptionsResolver();
        $this->configureDefaults($resolver);

        try {
            // Parse the config in admin_lte_theme.options as array object in admin_lte_context.options
            $newConfig = $resolver->resolve($config);
            // Change the internal storage array in the ArrayObject
            $this->exchangeArray($newConfig);
        } catch (UndefinedOptionsException $e) {
            echo $e->getMessage() . PHP_EOL;
            print_r($config, true);
        }
    }

    /**
     * Get attribute method for options. It uses a interal copy array of the
     * storage in the ArrayObject
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->getArrayCopy();
    }

    /**
     * @param $name
     * @param $value
     *
     * @return $this
     */
    public function setOption($name, $value)
    {
        $this->offsetSet($name, $value);

        return $this;
    }

    /**
     * @param $name
     *
     * @return bool
     */
    public function hasOption($name)
    {
        return $this->offsetExists($name);
    }

    /**
     * @param $name
     * @param null $default
     *
     * @return mixed|null
     */
    public function getOption($name, $default = null)
    {
        return $this->offsetExists($name) ? $this->offsetGet($name) : $default;
    }

    /**
     * @param $name
     *
     * @return bool
     */
    public function hasAlias($name)
    {
        return $this->router->hasAlias($name);
    }

    /**
     * @param $name
     *
     * @return mixed
     */
    public function fromAlias($name)
    {
        return $this->router->getRouteByAlias($name);
    }

    /**
     * @param OptionsResolver $resolver
     */
    protected function configureDefaults(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'options' => [],
            'skin' => 'skin-blue',
            'fixed_layout' => false,
            'boxed_layout' => false,
            'collapsed_sidebar' => false,
            'mini_sidebar' => false,
            'control_sidebar' => true,
            'default_avatar' => 'bundles/avanzuadmintheme/img/avatar.png',
            'widget' => [
                'collapsible_title' => 'Collapse',
                'removable_title' => 'Remove',
                'type' => 'primary',
                'bordered' => true,
                'collapsible' => true,
                'solid' => false,
                'removable' => false,
                'use_footer' => true,
            ],
            'button' => [
                'type' => 'primary',
                'size' => false,
            ],
            'knp_menu' => [
                'enable' => false,
                'main_menu' => 'avanzu_main',
                'breadcrumb_menu' => false,
            ],
        ]);
    }
}
