<?php

/*
 * This file is part of the AdminLTE bundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KevinPapst\AdminLTEBundle\Model;

/**
 * Interface MenuItemInterface
 */
interface MenuItemInterface
{
    /**
     * @return string
     */
    public function getIdentifier();

    /**
     * @return string
     */
    public function getLabel();

    /**
     * @return string
     */
    public function getRoute();

    /**
     * @return bool
     */
    public function isActive();

    /**
     * @param bool $isActive
     */
    public function setIsActive($isActive);

    /**
     * @return bool
     */
    public function hasChildren();

    /**
     * @return array
     */
    public function getChildren();

    /**
     * @param MenuItemInterface $child
     */
    public function addChild(MenuItemInterface $child);

    /**
     * @param MenuItemInterface $child
     */
    public function removeChild(MenuItemInterface $child);

    /**
     * @return string
     */
    public function getIcon();

    /**
     * @return string
     */
    public function getBadge();

    /**
     * @return string
     */
    public function getBadgeColor();

    /**
     * @return MenuItemInterface
     */
    public function getParent();

    /**
     * @return bool
     */
    public function hasParent();

    /**
     * @param MenuItemInterface $parent
     */
    public function setParent(MenuItemInterface $parent = null);

    /**
     * @return MenuItemInterface|null
     */
    public function getActiveChild();
}
