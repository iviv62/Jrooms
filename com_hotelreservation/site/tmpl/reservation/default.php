<?php
defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Language\Text;
?>
<div class="reservation-form">
    <h1><?php echo Text::_('COM_HOTELRESERVATION_FRONTEND_TITLE'); ?></h1>

    <form action="<?php echo Route::_('index.php?option=com_hotelreservation&task=reservation.submit'); ?>" method="post" class="form-validate">
        <fieldset>
            <div class="form-group">
                <label for="guest_name"><?php echo Text::_('COM_HOTELRESERVATION_FIELD_GUEST_NAME_LABEL'); ?></label>
                <input type="text" name="jform[guest_name]" id="guest_name" class="form-control" required="true" />
            </div>

            <div class="form-group">
                <label><?php echo Text::_('COM_HOTELRESERVATION_FIELD_DATES_LABEL'); ?></label>
                <div id="calendar-container"></div>
                <input type="hidden" name="jform[start_date]" id="start_date" />
                <input type="hidden" name="jform[end_date]" id="end_date" />
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary"><?php echo Text::_('COM_HOTELRESERVATION_SUBMIT_BUTTON'); ?></button>
            </div>
        </fieldset>
        <?php echo HTMLHelper::_('form.token'); ?>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const options = {
        type: 'multiple',
        actions: {
            clickDay(event, self) {
                const selectedDates = self.selectedDates;
                if (selectedDates.length > 1) {
                    document.getElementById('start_date').value = selectedDates[0];
                    document.getElementById('end_date').value = selectedDates[selectedDates.length - 1];
                }
            }
        },
        settings: {
            range: {
                disablePast: true,
            },
            selection: {
                day: 'multiple-ranged',
            },
            visibility: {
                daysOutside: false,
            },
        },
    };

    const calendar = new VanillaCalendarPro('#calendar-container', options);
    calendar.init();
});
</script>
