<?php
namespace Joomla\Component\HotelReservation\Site\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Factory;
use Joomla\CMS\Session\Session;

class ReservationController extends BaseController
{
    public function submit()
    {
        // Check for request forgeries
        Session::checkToken() or die('Invalid Token');

        $app   = Factory::getApplication();
        $input = $app->input;
        $data  = $input->get('jform', [], 'array');

        $model = $this->getModel('Reservation');

        if ($model->save($data)) {
            $app->enqueueMessage('Your reservation has been saved!', 'message');
        } else {
            $app->enqueueMessage('There was an error saving your reservation.', 'error');
        }

        // Redirect back to the form
        $this->setRedirect('index.php?option=com_hotelreservation');
    }
}
