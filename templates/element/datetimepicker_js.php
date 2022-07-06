<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/ja.js"></script>
<?php $this->Html->scriptStart(['block' => true]);?>
<?php if (false): ?><script type="text/javascript"><?php endif ?>
    const picker = document.querySelector('#datepicker');
    flatpickr(picker, {
        altInput: true,
        altFormat: "Y年Md日",
        allowInput: true,
        locale: 'ja',
        dateFormat: "Y-m-d",
        mode: 'multiple',
        conjunction: ',',
    });

    // const form  = document.querySelector('form');
    // form.addEventListener('submit', function (e) {
    //     const date = picker.getAttribute('value');
    //     console.log(date);
    //     if (date.indexOf('{') !== -1) {
    //     } else if (date.indexOf(',') === -1) {
    //         picker.setAttribute('name', 'event_dates[][date]');
    //     } else {
    //         const datesArray = date.split(',');
    //         for (const [k, v] of datesArray.entries()) {
    //             const input = document.createElement('input');
    //             input.setAttribute('type', 'hidden');
    //             input.setAttribute('value', v);
    //             input.setAttribute('name', `event_dates[${k}][date]`);
    //             form.appendChild(input);
    //         }
    //     }
    // });
    <?php if (false): ?></script><?php endif; ?>
<?php $this->Html->scriptEnd(); ?>
