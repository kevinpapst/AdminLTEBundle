<?php

/*
 * This file is part of the AdminLTE bundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KevinPapst\AdminLTEBundle\Helper;

class ContextHelper extends \ArrayObject
{
    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->getArrayCopy();
    }

    /**
     * @param string $name
     * @param mixed $value
     * @return $this
     */
    public function setOption(string $name, $value): ContextHelper
    {
        $this->offsetSet($name, $value);

        return $this;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasOption(string $name): bool
    {
        return $this->offsetExists($name);
    }

    /**
     * @param string $name
     * @param mixed $default
     * @return mixed|null
     */
    public function getOption(string $name, $default = null)
    {
        return $this->offsetExists($name) ? $this->offsetGet($name) : $default;
    }
}
