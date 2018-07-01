<?php

/*
 * This file is part of the AdminLTE bundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KevinPapst\AdminLTEBundle\Helper;

use Symfony\Component\OptionsResolver\Exception\UndefinedOptionsException;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContextHelper extends \ArrayObject
{
    /**
     * @param array $config The data under admin_lte_theme.options config
     */
    public function __construct(array $config)
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
     * TODO kevin - fetch defaults from configuration instead of being hardcoded at several places
     *
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
            'default_avatar' => 'bundles/adminlte/default_avatar.png',
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
                'main_menu' => 'adminlte_main',
                'breadcrumb_menu' => false,
            ],
        ]);
    }
}
