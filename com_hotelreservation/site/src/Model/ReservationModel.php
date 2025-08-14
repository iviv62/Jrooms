<?php
namespace Jules\Component\HotelReservation\Site\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\BaseDatabaseModel;
use Joomla\CMS\Factory;
use Joomla\CMS\Table\Table;

class ReservationModel extends BaseDatabaseModel
{
    public function save($data)
    {
        $table = Table::getInstance('Reservation', 'Jules\\Component\\HotelReservation\\Administrator\\Table');

        // Sanitize data before saving
        if (!empty($data['id'])) {
            $data['id'] = (int) $data['id'];
        } else {
            $data['id'] = 0;
        }

        $data['guest_name'] = htmlspecialchars($data['guest_name'], ENT_QUOTES, 'UTF-8');

        // Bind the data to the table
        if (!$table->bind($data)) {
            $this->setError($table->getError());
            return false;
        }

        // Validate the data
        if (!$table->check()) {
            $this->setError($table->getError());
            return false;
        }

        // Store the data
        if (!$table->store()) {
            $this->setError($table->getError());
            return false;
        }

        return true;
    }
}
