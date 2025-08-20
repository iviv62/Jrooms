<?php
namespace Joomla\Component\HotelReservation\Site\View\Reservation;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Factory;

class HtmlView extends BaseHtmlView
{
    public function display($tpl = null)
    {
        $wa = $this->getWebAssetManager();

        // Attach calendar CSS and JS
        $wa->registerAndUseStyle('com_hotelreservation.calendar', 'media/com_hotelreservation/css/calendar.css');
        $wa->registerAndUseScript('com_hotelreservation.calendar', 'media/com_hotelreservation/js/calendar.js', [], ['defer' => true]);

        // Attach component's main CSS
        $wa->registerAndUseStyle('com_hotelreservation.site', 'media/com_hotelreservation/css/style.css');

        parent::display($tpl);
    }
}
