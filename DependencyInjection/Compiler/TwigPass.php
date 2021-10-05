<?php

/*
 * This file is part of the AdminLTE bundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KevinPapst\AdminLTEBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class TwigPass
 */
class TwigPass implements CompilerPassInterface
{
    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $bundles = $container->getParameter('kernel.bundles');

        if (!isset($bundles['TwigBundle'])) {
            return;
        }

        $param = $container->getParameter('twig.form.resources');

        if (!\is_array($param)) {
            $param = [];
        }

        $container->setParameter('twig.form.resources', $param);

        $twigDefinition = $container->getDefinition('twig');

        $twigDefinition->addMethodCall(
            'addGlobal',
            [
                'admin_lte_context',
                new Reference('admin_lte_theme.context_helper'),
            ]
        );
    }
}
