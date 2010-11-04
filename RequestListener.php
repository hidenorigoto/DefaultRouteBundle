<?php

namespace Bundle\DefaultRouteBundle;

use Symfony\Component\HttpKernel\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;

/**
 * RequestListener.
 *
 * @author hidenorigoto <hidenorigoto@gmail.com>
 */
class RequestListener
{
    protected $router;
    protected $logger;

    public function __construct(RouterInterface $router, LoggerInterface $logger = null)
    {
        $this->router = $router;
        $this->logger = $logger;
    }

    /**
     * Registers a core.request listener.
     *
     * @param EventDispatcher $dispatcher An EventDispatcher instance
     * @param integer         $priority   The priority
     */
    public function register(EventDispatcher $dispatcher, $priority = 0)
    {
        $dispatcher->connect('core.request', array($this, 'resolve'), $priority);
    }

    public function resolve(Event $event)
    {
        $request = $event->getParameter('request');

        if (HttpKernelInterface::MASTER_REQUEST === $event->getParameter('request_type')) {
            // set the context even if the parsing does not need to be done
            // to have correct link generation
            $this->router->setContext(array(
                'base_url'  => $request->getBaseUrl(),
                'method'    => $request->getMethod(),
                'host'      => $request->getHost(),
                'is_secure' => $request->isSecure(),
            ));
        }

        if ($request->attributes->has('_controller')) {
            return;
        }

        $url = $request->getPathInfo();

        $parts = explode('/', $url);
        if (count($parts) < 4) {
            return;
        }

        $controllerName = sprintf(
            'Application\\%sBundle\\Controller\\%sController::%sAction',
            $parts[1],
            $parts[2],
            $parts[3]
        );

        $request->attributes->add(array('_controller'=> $controllerName));
    }
}
