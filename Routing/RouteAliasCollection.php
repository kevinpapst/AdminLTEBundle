<?php

/*
 * This file is part of the AdminLTE bundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AdminLTEBundle\Routing;

use Symfony\Component\Config\ConfigCache;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouterInterface;

class RouteAliasCollection
{
    /**
     * @var string
     */
    protected $cacheDir;

    /**
     * @var RouterInterface
     */
    protected $router;

    /**
     * @var array
     */
    protected $routeAliases = null;

    /**
     * @var string
     */
    protected $optionName;

    /**
     * @var string
     */
    protected $env;

    /**
     * @var bool
     */
    private $debug;

    /**
     * RouteAliasCollection constructor.
     *
     * @param $cacheDir
     * @param RouterInterface $router
     * @param $optionName
     * @param $env
     * @param $debug
     */
    public function __construct($cacheDir, RouterInterface $router, $optionName, $env, $debug)
    {
        $this->cacheDir = $cacheDir;
        $this->router = $router;
        $this->optionName = $optionName;
        $this->debug = $debug;
        $this->env = $env;
    }

    /**
     * @return string
     */
    protected function getCacheFileName()
    {
        return sprintf(
            '%s/AliasRoutes/%s%s.php',
            $this->cacheDir,
            ucfirst($this->env),
            Container::camelize($this->optionName)
        );
    }

    /**
     * @return \Symfony\Component\Config\Resource\ResourceInterface[]
     */
    public function getResources()
    {
        return $this->router->getRouteCollection()->getResources();
    }

    /**
     * @param $name
     *
     * @return bool
     */
    public function hasAlias($name)
    {
        $aliases = $this->getAliases();

        return isset($aliases[$name]);
    }

    /**
     * @param $name
     *
     * @return mixed
     */
    public function getRouteByAlias($name)
    {
        $aliases = $this->getAliases();

        return $aliases[$name] ?? null;
    }

    /**
     * @return array|mixed
     */
    public function getAliases()
    {
        if (!is_null($this->routeAliases)) {
            return $this->routeAliases;
        }

        $cache = new ConfigCache($this->getCacheFileName(), $this->debug);

        if ($cache->isFresh()) {
            $this->routeAliases = unserialize(file_get_contents($cache->getPath()));

            return $this->routeAliases;
        }

        $this->routeAliases = $this->loadRoutes();
        $cache->write(serialize($this->routeAliases), $this->getResources());

        return $this->routeAliases;
    }

    /**
     * @return array
     */
    protected function loadRoutes()
    {
        $aliases = [];
        foreach ($this->router->getRouteCollection()->all() as $name => $candidate) {
            if (!$this->hasConfiguredOption($candidate)) {
                continue;
            }

            $aliases[$candidate->getOption($this->optionName)] = $name;
        }

        return $aliases;
    }

    /**
     * @param Route $route
     *
     * @return bool
     */
    public function hasConfiguredOption(Route $route)
    {
        if (!$route->hasOption($this->optionName)) {
            return false;
        }

        return true;
    }
}
