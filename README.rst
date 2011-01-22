This is a DefaultReouteBundle for Symfony2
==========================================

This bundle adds a default automatic route like symfony 1.
It routes automatically the url '/Hello/Hello/index' to index action of Hello controller of Hello bundle in your Application.

How to install
--------------

First, add this bundle to your project. If you use git, add this bundle to the submodule as follows.::

    $ git submodule add git://github.com/hidenorigoto/DefaultRouteBundle.git src/Xnni/DefaultRouteBundle

Then register this bundle in your AppKernel.::

    public function registerBundles()
    {
        $bundles = array(
            // :
            new Xnni\DefaultRouteBundle\XnniDefaultRouteBundle(),
            // :
        );

Finaly, enable this bundle in your config(config.yml) as follows.::

    # defaultroute
    defaultroute.config: ~

How to use
----------

If you made your application in following condition,

- bundle namespace: App\HelloBundle
- controller: Default
- action: indexAction

then you can access this action with url such as 'http://localhost/app_dev.php/Hello/Default/index

- Currently, supports only App namespace


