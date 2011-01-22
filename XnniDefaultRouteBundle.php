<?php

namespace Xnni\DefaultRouteBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class XnniDefaultRouteBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function getNamespace()
    {
        return __NAMESPACE__;
    }

    /**
     * {@inheritdoc}
     */
    public function getPath()
    {
        return strtr(__DIR__, '\\', '/');
    }
}
