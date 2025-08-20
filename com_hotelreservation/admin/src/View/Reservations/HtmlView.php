<?php
namespace Joomla\Component\HotelReservation\Administrator\View\Reservations;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\ToolbarHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;

class HtmlView extends BaseHtmlView
{
    protected $items;
    protected $pagination;
    protected $state;

    public function display($tpl = null)
    {
        $this->items      = $this->get('Items');
        $this->pagination = $this->get('Pagination');
        $this->state      = $this->get('State');

        // Check for errors.
        if (count($errors = $this->get('Errors'))) {
            throw new \Exception(implode("\n", $errors), 500);
        }

        $this->addToolbar();

        parent::display($tpl);
    }

    protected function addToolbar()
    {
        $canDo = Factory::getApplication()->getIdentity()->authorise('core.admin', 'com_hotelreservation');

        ToolbarHelper::title(Text::_('COM_HOTELRESERVATION_RESERVATIONS'), 'calendar');

        if ($canDo) {
            ToolbarHelper::addNew('reservation.add');
            ToolbarHelper::editList('reservation.edit');
            ToolbarHelper::deleteList('Are you sure?', 'reservations.delete');
        }
    }
}
