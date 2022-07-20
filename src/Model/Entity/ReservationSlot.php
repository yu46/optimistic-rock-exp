<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ReservationSlot Entity
 *
 * @property int $id
 * @property int $max
 * @property int $remaining
 * @property \Cake\I18n\Time $time_from
 * @property \Cake\I18n\Time $time_to
 * @property int $version
 * @property int $event_date_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\EventDate $event_date
 */
class ReservationSlot extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'max' => true,
        'remaining' => false,
        'time_from' => true,
        'time_to' => true,
        'version' => false,
        'event_date_id' => true,
        'created' => true,
        'modified' => true,
        'event_date' => true,
    ];
}
