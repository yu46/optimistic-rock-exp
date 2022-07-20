<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ReservationSlot $reservationSlot
 */
?>
<?php
$this->assign('title', __('Add {0}', __('Reservation Slot')));
$this->Breadcrumbs->add([
    ['title' => __('List of {0}', __('Reservation Slots')), 'url' => ['action' => 'index']],
    ['title' => $this->fetch('title'), 'url' => null],
]);
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/ja.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/rangePlugin.js"></script>
<?php $this->Html->scriptStart(['block' => true]);?>
<?php if (false): ?><script type="text/javascript"><?php endif ?>
    const timeFrom = document.querySelector('#time-from');
    const timeTo = document.querySelector('#time-to');
    flatpickr(timeFrom, {
        enableTime: true,
        // altFormat: "Y年Md日",
        allowInput: true,
        locale: 'ja',
        time_24hr: true,
        noCalendar: true,
        dateFormat: "H:i",
        minuteIncrement: 11,
        position: 'above',
    });
    flatpickr(timeTo, {
        enableTime: true,
        allowInput: true,
        locale: 'ja',
        time_24hr: true,
        noCalendar: true,
        dateFormat: "H:i",
        minuteIncrement: 15,
        position: 'below',
    });
    <?php if (false): ?></script><?php endif; ?>
<?php $this->Html->scriptEnd(); ?>

<?php $this->Html->scriptStart(['block' => true]);?>
<?php if (false): ?><script type="text/javascript"><?php endif ?>
    window.addEventListener('load', function () {
        const eventField = document.getElementById('event')
        const eventDateTr = document.getElementById('event-date-tr')
        if (eventField.value) {
            eventDateTr.style.display = '';
            requestEventDates(eventField.value);
        } else {
            eventDateTr.style.display = 'none';
        }

        eventField.addEventListener('change', function (e) {
            const eventId = e.target.value;
            if (! eventId) {
                eventDateTr.style.display = 'none';
                return;
            }

            eventDateTr.style.display = '';
            requestEventDates(eventId);
        });
    });

    function requestEventDates(eventId) {
        const url = '<?= \Cake\Routing\Router::url([
                'prefix' => 'Admin/Api',
                'controller' => 'ReservationSlots',
                'action' => 'dates',
                                                   ])?>'
            + '/'
            + eventId;

        const selectBox = document.getElementById('event-dates');
        selectBox.innerHTML = '';

        fetch(url)
            .then((res) => res.json())
            .then((json) => {
                for (const key of Object.keys(json)) {
                    appendOptionTag(json[key], selectBox);
                }
            });
    }
    const eventDateId = '<?= $reservationSlot->event_date_id ?>';
    function appendOptionTag(obj, element) {
        const option = document.createElement('option');
        option.setAttribute('value', obj.id);
        option.textContent = obj.date;
        if (eventDateId && String(obj.id) === eventDateId) {
            option.setAttribute('selected', 'selected');
        }

        element.append(option);
    }

    <?php if (false): ?></script><?php endif; ?>
<?php $this->Html->scriptEnd(); ?>

<div class="row">
    <div class="col-md-12">
        <!-- general form elements -->
        <?php echo $this->Form->create($reservationSlot, ['role' => 'form', 'novalidate' => true]); ?>
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo __('Form'); ?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">
                <table class="table table-bordered">
                    <?= $this->cell('EventSelector::display', [$this, 'event_id']) ?>
                    <tr id="event-date-tr" style="display: none">
                        <th><?= $this->Form->label('event_date_id', '開催日', ['required' => true]) ?></th>
                        <td>
                            <?= $this->Form->control(
                                'event_date_id',
                                [
                                    'id' => 'event-dates',
                                    'type' => 'select',
                                    'options' => [],
                                    'label' => false,
                                ]
                            ) ?>
                        </td>
                    </tr>

                    <tr>
                        <th><?php echo $this->Form->label('max'); ?></th>
                        <td><?php echo $this->Form->control('max', [
                                'type' => 'text',
                            ]); ?>
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo $this->Form->label('time_from', '時間帯'); ?></th>
                        <td>
                            <div class="row <?= $this->Form->isFieldError('time_to') ? 'has-error' : '' ?>">
                                <?php echo $this->Form->control('time_from', [
                                    'type' => 'text',
                                    'templates' => [
                                        'inputContainer' => '<div class="col-sm-4 input {{type}}{{required}}">{{content}}</div>',
                                        'inputContainerError' => '<div class="col-sm-4 input {{type}}{{required}} has-error">{{content}}{{error}}</div>',
                                    ],
                                    'class' => 'form-control',
                                    'empty' => true,
                                ]); ?>
                                <div class="col-sm-1 text-center" style="padding-top: 5px;">〜</div>
                                <?php echo $this->Form->control('time_to', [
                                    'type' => 'text',
                                    'templates' => [
                                        'inputContainer' => '<div class="col-sm-4 input {{type}}{{required}}">{{content}}</div>',
                                        'inputContainerError' => '<div class="col-sm-4 input {{type}}{{required}} has-error">{{content}}{{error}}</div>',
                                    ],
                                    'class' => 'form-control',
                                    'empty' => true,
                                ]); ?>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="box-footer text-center">
                <?php echo $this->Form->button(__('Confirm'), [
                    'type' => 'submit',
                    'name' => 'confirm',
                    'class' => 'btn btn-success']); ?>
            </div>
        </div>
        <!-- /.box -->
        <?= $this->Form->end() ?>
    </div>
    <!-- /.col-md-12 -->
</div>
<!-- /.row -->

