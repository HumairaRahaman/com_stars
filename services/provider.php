<?php

use Joomla\CMS\Extension\ComponentInterface;
use Joomla\CMS\Extension\Service\Provider\ComponentDispatcherFactory;
use Joomla\CMS\Extension\Service\Provider\MVCFactory;
use Joomla\CMS\Dispatcher\ComponentDispatcherFactoryInterface;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;
use TechFry\Component\Stars\Administrator\Extension\StarsComponent;

return new class implements ServiceProviderInterface
{
    public function register(Container $container)
    {
        $container->registerServiceProvider(new ComponentDispatcherFactory('\\TechFry\\Component\\Stars'));
        $container->registerServiceProvider(new MVCFactory('\\TechFry\\Component\\Stars'));
    
        $container->set(
            ComponentInterface::class,
            function (Container $container) 
            {
                $component = new StarsComponent($container->get(ComponentDispatcherFactoryInterface::class));
                $component->setMVCFactory($container->get(MVCFactoryInterface::class));

                return $component;
            }
        );
    }
};