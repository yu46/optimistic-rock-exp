<?php
declare(strict_types=1);

namespace App\View\Cell;

use App\View\AppView;
use Cake\View\Cell;

/**
 * EventSelector cell
 */
class EventSelectorCell extends Cell
{
    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array<string, mixed>
     */
    protected $_validCellOptions = [];

    /**
     * Initialization logic run at the end of object construction.
     *
     * @return void
     */
    public function initialize(): void
    {
    }

    /**
     * Default display method.
     *
     * @param \App\View\AppView $view  view
     * @param string $fieldName fieldName
     * @return void
     */
    public function display(AppView $view, string $fieldName): void
    {
        $formHelper = $view->Form;

        $Events = $this->fetchTable('Events');
        $events = $Events
            ->find('list')
            ->orderAsc($Events->aliasField('id'))
            ->all();

        $this->set([
            'events' => $events,
            'formHelper' => $formHelper,
            'fieldName' => $fieldName,
                       ]);
    }
}
