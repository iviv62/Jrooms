<?php
namespace Jules\Component\HotelReservation\Administrator\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\AdminController;

class ReservationsController extends AdminController
{
    public function getModel($name = 'Reservations', $prefix = 'Administrator', $config = ['ignore_request' => true])
    {
        return parent::getModel($name, $prefix, $config);
    }
}
