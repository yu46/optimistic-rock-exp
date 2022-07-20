<?php
/**
 * @var \Cake\View\Helper\FormHelper $formHelper
 * @var array $events
 * @var string $fieldName
 */

?>
<tr>
    <th><?= $formHelper->label($fieldName, 'イベント名', ['required' => true]) ?></th>
    <td>
        <?= $formHelper->control(
            $fieldName,
            [
                'templates' => [
                    'formGroup' => '{{label}}{{input}}',
                ],
                'id' => 'event',
                'type' => 'select',
                'options' => $events,
                'empty' => ['' => ''],
                'label' => false,
            ]
        ) ?>
    </td>
</tr>
