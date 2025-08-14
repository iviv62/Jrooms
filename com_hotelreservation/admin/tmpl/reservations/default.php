<?php
defined('_JEXEC') or die;

use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

HTMLHelper::_('behavior.multiselect');
?>
<form action="<?php echo htmlspecialchars('index.php?option=com_hotelreservation&view=reservations'); ?>" method="post" name="adminForm" id="adminForm">
    <div class="row">
        <div class="col-md-12">
            <div class="j-main-container">
                <table class="table table-striped" id="reservationList">
                    <thead>
                        <tr>
                            <th width="1%" class="text-center">
                                <?php echo HTMLHelper::_('grid.checkall', $this); ?>
                            </th>
                            <th style="min-width:150px">
                                <?php echo Text::_('COM_HOTELRESERVATION_FIELD_GUEST_NAME_LABEL'); ?>
                            </th>
                            <th class="text-center">
                                <?php echo Text::_('COM_HOTELRESERVATION_FIELD_START_DATE_LABEL'); ?>
                            </th>
                            <th class="text-center">
                                <?php echo Text::_('COM_HOTELRESERVATION_FIELD_END_DATE_LABEL'); ?>
                            </th>
                            <th class="text-center">
                                <?php echo Text::_('COM_HOTELRESERVATION_FIELD_STATUS_LABEL'); ?>
                            </th>
                            <th width="5%" class="text-center">
                                <?php echo Text::_('COM_HOTELRESERVATION_FIELD_ID_LABEL'); ?>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($this->items)) : ?>
                            <?php foreach ($this->items as $i => $item) : ?>
                                <tr class="row<?php echo $i % 2; ?>">
                                    <td class="text-center">
                                        <?php echo HTMLHelper::_('grid.id', $i, $item->id); ?>
                                    </td>
                                    <td>
                                        <a href="#"><?php echo $this->escape($item->guest_name); ?></a>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $this->escape($item->start_date); ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $this->escape($item->end_date); ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $this->escape($item->status); ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo (int) $item->id; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6">
                                <?php echo $this->pagination->getListFooter(); ?>
                            </td>
                        </tr>
                    </tfoot>
                </table>

                <input type="hidden" name="task" value="" />
                <input type="hidden" name="boxchecked" value="0" />
                <?php echo HTMLHelper::_('form.token'); ?>
            </div>
        </div>
    </div>
</form>
