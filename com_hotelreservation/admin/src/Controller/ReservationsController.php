<?php
namespace Joomla\Component\HotelReservation\Administrator\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\AdminController;

class ReservationsController extends AdminController
{
    protected $view_list = 'reservations';

    public function getModel($name = 'Reservations', $prefix = 'Administrator', $config = ['ignore_request' => true])
    {
        return parent::getModel($name, $prefix, $config);
    }
}
