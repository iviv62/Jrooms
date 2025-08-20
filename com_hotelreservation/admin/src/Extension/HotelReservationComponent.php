<?php
namespace Joomla\Component\HotelReservation\Administrator\Extension;

defined('_JEXEC') or die;

use Joomla\CMS\Extension\MVCComponent;

class HotelReservationComponent extends MVCComponent
{
    public function getNamespace(): string
    {
        return 'Jules\\Component\\HotelReservation';
    }
}


