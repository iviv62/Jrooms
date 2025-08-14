<?php
namespace Jules\Component\HotelReservation\Administrator\Table;

defined('_JEXEC') or die;

use Joomla\CMS\Table\Table;
use Joomla\Database\DatabaseDriver;

class ReservationTable extends Table
{
    public function __construct(DatabaseDriver $db)
    {
        parent::__construct('#__hotelreservation_reservations', 'id', $db);
    }
}
