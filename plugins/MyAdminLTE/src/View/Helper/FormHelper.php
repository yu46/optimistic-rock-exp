<?php
declare(strict_types=1);

namespace MyAdminLTE\View\Helper;

use Cake\Utility\Hash;
use Cake\View\Helper\FormHelper as CakeFormHelper;
use Cake\View\View;

class FormHelper extends CakeFormHelper
{

    private $templates = [
        'button' => '<button{{attrs}}>{{text}}</button>',
        'checkbox' => '<input type="checkbox" name="{{name}}" value="{{value}}"{{attrs}}>',
        'checkboxFormGroup' => '{{label}}',
        'checkboxWrapper' => '<div class="checkbox">{{label}}</div>',
        'dateWidget' => '<div class="form-group">{{label}} {{year}}{{month}}{{day}}{{hour}}{{minute}}{{second}}{{meridian}}</div>',
        'error' => '<span class="help-block">{{content}}</span>',
        'errorList' => '<ul>{{content}}</ul>',
        'errorItem' => '<li>{{text}}</li>',
        'file' => '<input type="file" name="{{name}}"{{attrs}}>',
        'fieldset' => '<fieldset{{attrs}}>{{content}}</fieldset>',
        'formStart' => '<form{{attrs}}>',
        'formEnd' => '</form>',
        'formGroup' => '{{label}}{{input}}',
        'hiddenBlock' => '<div style="display:none;">{{content}}</div>',
        'control' => '<input type="{{type}}" name="{{name}}"{{attrs}}/>',
        'input' => '<input type="{{type}}" name="{{name}}"{{attrs}}/>',
        'inputSubmit' => '<input type="{{type}}"{{attrs}}/>',
        'inputContainer' => '<div class="input {{type}}{{required}}">{{content}}</div>',
        'inputContainerError' => '<div class="input {{type}}{{required}} has-error">{{content}}{{error}}</div>',
        'label' => '{{required}}<label class="control-label" {{attrs}}>{{text}}</label>',
        'nestingLabel' => '{{hidden}}<label{{attrs}}>{{input}}{{text}}</label>',
        'legend' => '<legend>{{text}}</legend>',
        'multicheckboxTitle' => '<legend>{{text}}</legend>',
        'multicheckboxWrapper' => '<fieldset{{attrs}}>{{content}}</fieldset>',
        'option' => '<option value="{{value}}"{{attrs}}>{{text}}</option>',
        'optgroup' => '<optgroup label="{{label}}"{{attrs}}>{{content}}</optgroup>',
        'select' => '<select name="{{name}}"{{attrs}}>{{content}}</select>',
        'selectMultiple' => '<select name="{{name}}[]" multiple="multiple"{{attrs}}>{{content}}</select>',
        'radio' => '<input type="radio" name="{{name}}" value="{{value}}"{{attrs}}>',
        'radioWrapper' => '<div class="radio">{{label}}</div>',
        'textarea' => '<textarea name="{{name}}"{{attrs}}>{{value}}</textarea>',
        'submitContainer' => '<div class="box-footer {{required}}">{{content}}</div>',
        'requiredLabel' => '<span class="label label-danger" style="font-size: 80%;">必須</span>&nbsp;',
    ];

    /**
     * @var \string[][]
     */
    private $widgets = [
        'label' => ['MyAdminLTE\\View\\Widget\\LabelWidget'],
        'datetime' => ['MyAdminLTE\\View\\Widget\\DateTimeWidget', 'select'],
    ];

    /**
     * The supported sources that can be used to populate input values.
     *
     * `context` - Corresponds to `ContextInterface` instances.
     * `data` - Corresponds to request data (POST/PUT).
     * `query` - Corresponds to request's query string.
     *
     * @var string[]
     */
    protected $supportedValueSources = ['context', 'data', 'query', 'searchQuery'];

    public function __construct(View $View, array $config = [])
    {
        $this->_defaultConfig['templates'] = array_merge($this->_defaultConfig['templates'], $this->templates);
        $this->_defaultWidgets = array_merge($this->_defaultWidgets, $this->widgets);
        parent::__construct($View, $config);
    }

    public function create($context = null, array $options = []): string
    {
        $options += ['role' => 'form'];
        return parent::create($context, $options);
    }

    public function button(string $title, array $options = []): string
    {
        $options += ['escape' => false, 'secure' => false, 'class' => 'btn btn-success'];
        $options['text'] = $title;
        return $this->widget('button', $options);
    }

    public function submit(?string $caption = null, array $options = []): string
    {
        $options += ['class' => 'btn btn-success'];
        return parent::submit($caption, $options);
    }

    /**
     *
     * {@inheritDoc}
     * @see \Cake\View\Helper\FormHelper::input()
     * @deprecated 1.1.1 Use FormHelper::control() instead, due to \Cake\View\Helper\FormHelper::input() deprecation
     */
    public function input($fieldName, array $options = [])
    {

        $_options = [];

        if (!isset($options['type'])) {
            $options['type'] = $this->_inputType($fieldName, $options);
        }

        switch ($options['type']) {
            case 'checkbox':
            case 'radio':
            case 'date':
                break;
            default:
                $_options = ['class' => 'form-control'];
                break;

        }

        $options += $_options;

        return parent::control($fieldName, $options);
    }

    public function control(string $fieldName, array $options = []): string
    {

        $_options = [];

        if (!isset($options['type'])) {
            $options['type'] = $this->_inputType($fieldName, $options);
        }

        switch ($options['type']) {
            case 'checkbox':
            case 'radio':
                break;
            case 'date':
            case 'datetime':
                $_options = ['class' => 'form-control', 'autocomplete' => 'off'];
                break;
            default:
                $_options = ['class' => 'form-control'];
                break;

        }

        $options += $_options;

        return parent::control($fieldName, $options);
    }

    /**
     * @param string $fieldName filename
     * @param string|null $text text
     * @param array $options options
     * @return string
     */
    public function label(string $fieldName, ?string $text = null, array $options = []): string
    {
        $context = $this->_getContext();
        if (!isset($options['required']) && $context->isRequired($fieldName)) {
            $options['required'] = true;
        }

        return parent::label($fieldName, $text, $options);
    }

    /**
     * Gets a single field value from the sources available.
     *
     * @param string $fieldname The fieldname to fetch the value for.
     * @param array $options The options containing default values.
     * @return mixed Field value derived from sources or defaults.
     */
    public function getSourceValue(string $fieldname, array $options = [])
    {
        $valueMap = [
            'data' => 'getData',
            'query' => 'getQuery',
        ];
        foreach ($this->getValueSources() as $valuesSource) {
            if ($valuesSource === 'context') {
                $val = $this->_getContext()->val($fieldname, $options);
                if ($val !== null) {
                    return $val;
                }
            } elseif($valuesSource === 'searchQuery') {
                $searchQuery = $this->_View->getRequest()->getAttribute('searchQuery');
                $value = Hash::get($searchQuery, $fieldname, null);
                if ($value !== null) {
                    return $value;
                }
            }

            if (isset($valueMap[$valuesSource])) {
                $method = $valueMap[$valuesSource];
                $value = $this->_View->getRequest()->{$method}($fieldname);
                if ($value !== null) {
                    return $value;
                }
            }
        }

        return null;
    }
}
