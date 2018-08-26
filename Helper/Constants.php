<?php

/*
 * This file is part of the AdminLTE bundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KevinPapst\AdminLTEBundle\Helper;

interface Constants
{
    public const COLOR_AQUA = 'aqua';
    public const COLOR_GREEN = 'green';
    public const COLOR_RED = 'red';
    public const COLOR_YELLOW = 'yellow';
    public const COLOR_GREY = 'grey';
    public const COLOR_BLACK = 'black';

    /**
     * Used in:
     * - Model\NotificationModel
     * - Twig\AdminExtension
     */
    public const TYPE_SUCCESS = 'success';
    public const TYPE_WARNING = 'warning';
    public const TYPE_ERROR = 'error';
    public const TYPE_INFO = 'info';
}
