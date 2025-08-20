<?php
/**
 * Joomla 5 service provider for com_hotelreservation
 */

defined('_JEXEC') or die;

// Ensure the component extension class is available when the provider runs
@require_once __DIR__ . '/../src/Extension/HotelReservationComponent.php';

use Joomla\CMS\Extension\ComponentInterface;
use Joomla\CMS\Extension\Service\Provider\ComponentDispatcherFactory;
use Joomla\CMS\Extension\Service\Provider\MVCFactory as MVCFactoryProvider;
use Joomla\CMS\Dispatcher\ComponentDispatcherFactoryInterface;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;

use Joomla\Component\HotelReservation\Administrator\Extension\HotelReservationComponent;

return new class implements ServiceProviderInterface {
    public function register(Container $container)
    {
        // Register dispatcher factory with the PHP namespace of the component (per J5 API)
        $container->registerServiceProvider(new ComponentDispatcherFactory('Joomla\\Component\\HotelReservation'));
        $container->registerServiceProvider(new MVCFactoryProvider('com_hotelreservation'));

        $container->set(
            ComponentInterface::class,
            function (Container $container) {
                return new HotelReservationComponent(
                    $container->get(ComponentDispatcherFactoryInterface::class),
                    $container->get(MVCFactoryInterface::class)
                );
            }
        );
    }
};


