<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         3.0.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

namespace MyAdminLTE\View\Widget;

use Cake\View\Form\ContextInterface;
use Cake\View\Widget\DateTimeWidget as CoreDateTimeWidget;
use Psr\Log\InvalidArgumentException;

/**
 * Form 'widget' for creating labels.
 *
 * Generally this element is used by other widgets,
 * and FormHelper itself.
 */
class DateTimeWidget extends CoreDateTimeWidget
{
    /**
     * Data defaults.
     *
     * @var array
     */
    protected $defaults = [
        'name' => '',
        'val' => null,
        'type' => 'text',
        'escape' => true,
        'timezone' => null,
        'templateVars' => [],
    ];

    /**
     * Formats for various input types.
     *
     * @var string[]
     */
    protected $formatMap = [
        'datetime-local' => 'Y-m-d H:i:s',
        'date' => 'Y-m-d',
        'time' => 'H:i:s',
        'month' => 'Y-m',
        'week' => 'Y-\WW',
    ];

    /**
     * Render a date / time form widget.
     *
     * Data supports the following keys:
     *
     * - `name` The name attribute.
     * - `val` The value attribute.
     * - `escape` Set to false to disable escaping on all attributes.
     * - `type` A valid HTML date/time input type. Defaults to "datetime-local".
     * - `timezone` The timezone the input value should be converted to.
     * - `step` The "step" attribute. Defaults to `1` for "time" and "datetime-local" type inputs.
     *   You can set it to `null` or `false` to prevent explicit step attribute being added in HTML.
     * - `format` A `date()` function compatible datetime format string.
     *   By default the widget will use a suitable format based on the input type and
     *   database type for the context. If an explicit format is provided, then no
     *   default value will be set for the `step` attribute, and it needs to be
     *   explicitly set if required.
     *
     * All other keys will be converted into HTML attributes.
     *
     * @param array $data The data to build a file input with.
     * @param \Cake\View\Form\ContextInterface $context The current form context.
     * @return string HTML elements.
     */
    public function render(array $data, ContextInterface $context): string
    {
        $data += $this->mergeDefaults($data, $context);

        if (!isset($this->formatMap[$data['type']])) {
            throw new InvalidArgumentException(sprintf(
                'Invalid type `%s` for input tag, expected datetime-local, date, time, month or week',
                $data['type']
            ));
        }

        $data = $this->setStep($data, $context, $data['fieldName'] ?? '');

        $data['value'] = $this->formatDateTime($data['val'], $data);
        unset($data['val'], $data['timezone'], $data['format']);

        return $this->_templates->format('input', [
            'name' => $data['name'],
            'type' => 'text',
            'templateVars' => $data['templateVars'],
            'attrs' => $this->_templates->formatAttributes(
                $data,
                ['name', 'type']
            ),
        ]);
    }
}
