<?php
namespace Joomla\Component\HotelReservation\Administrator\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ListModel;
use Joomla\CMS\Factory;

class ReservationsModel extends ListModel
{
    public function __construct($config = [])
    {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = [
                'id', 'a.id',
                'guest_name', 'a.guest_name',
                'status', 'a.status',
            ];
        }

        parent::__construct($config);
    }

    protected function getListQuery()
    {
        $db    = Factory::getDbo();
        $query = $db->getQuery(true);

        $query->select($this->getState(
            'list.select',
            'a.id, a.room_id, a.start_date, a.end_date, a.guest_name, a.status'
        ));
        $query->from($db->quoteName('#__hotelreservation_reservations', 'a'));

        // Add sorting
        $orderCol  = $this->state->get('list.ordering', 'a.id');
        $orderDirn = $this->state->get('list.direction', 'asc');
        $query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));

        return $query;
    }
}
