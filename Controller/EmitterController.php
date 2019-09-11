<?php

/*
 * This file is part of the AdminLTE bundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KevinPapst\AdminLTEBundle\Controller;

use Symfony\Component\EventDispatcher\LegacyEventDispatcherProxy;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpKernel\Kernel;

class EmitterController extends AbstractController
{
    /**
     * @var EventDispatcherInterface
     */
    protected $eventDispatcher;

    /**
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct(EventDispatcherInterface $dispatcher)
    {
        if (Kernel::MINOR_VERSION < 3) {
            $this->eventDispatcher = LegacyEventDispatcherProxy::decorate($dispatcher);
        } else {
            $this->eventDispatcher = $dispatcher;
        }
    }

    /**
     * @return EventDispatcherInterface
     */
    protected function getDispatcher()
    {
        return $this->eventDispatcher;
    }

    /**
     * @param string $eventName
     *
     * @return bool
     */
    protected function hasListener($eventName)
    {
        return $this->getDispatcher()->hasListeners($eventName);
    }

    /**
     * Will look for a method of the format "on<CamelizedEventName>" and call it with the event as argument.
     *
     *
     * Then it will dispatch the event as normal via the event dispatcher.
     *
     * @param string $eventName
     * @param Event $event
     *
     * @return Event
     */
    protected function triggerMethod($eventName, Event $event)
    {
        $method = sprintf('on%s', Container::camelize(str_replace('.', '_', $eventName)));

        if (is_callable([$this, $method])) {
            call_user_func_array([$this, $method], [$event]);
        }

        if ($event->isPropagationStopped()) {
            return $event;
        }

        $this->getDispatcher()->dispatch($eventName, $event);

        return $event;
    }
}
