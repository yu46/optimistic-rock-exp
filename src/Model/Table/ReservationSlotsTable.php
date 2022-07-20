<?php
declare(strict_types=1);

namespace App\Model\Table;

use App\Model\Entity\ReservationSlot;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ReservationSlots Model
 *
 * @property \App\Model\Table\EventDatesTable&\Cake\ORM\Association\BelongsTo $EventDates
 *
 * @method \App\Model\Entity\ReservationSlot newEmptyEntity()
 * @method \App\Model\Entity\ReservationSlot newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ReservationSlot[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ReservationSlot get($primaryKey, $options = [])
 * @method \App\Model\Entity\ReservationSlot findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ReservationSlot patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ReservationSlot[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ReservationSlot|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ReservationSlot saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ReservationSlot[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ReservationSlot[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ReservationSlot[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ReservationSlot[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ReservationSlotsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('reservation_slots');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('EventDates', [
            'foreignKey' => 'event_date_id',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator->setProvider('custom', 'App\Model\Validation\CustomValidation');

        $validator
            ->nonNegativeInteger('max')
            ->requirePresence('max', 'create')
            ->notEmptyString('max');

        $validator
            ->time('time_from')
            ->requirePresence('time_from', 'create')
            ->notEmptyTime('time_from')
            ->add('time_from', 'time_interval', [
                'rule' => ['every15Min'],
                'provider' => 'custom',
                'message' => '不正な値です',
            ]);

        $validator
            ->time('time_to')
            ->requirePresence('time_to', 'create')
            ->notEmptyTime('time_to')
            ->add('time_to', 'time_interval', [
                'rule' => ['every15min'],
                'provider' => 'custom',
                'message' => '不正な値です',
            ])
            ->add('time_to', 'dateOrder', [
                'rule' => ['dateOrder', 'time_from'],
                'provider' => 'custom',
                'message' => '終了時刻は開始時刻より前には設定できません',
            ]);

        $validator
            ->integer('event_date_id')
            ->requirePresence('event_date_id', 'create')
            ->notEmptyString('event_date_id');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('event_date_id', 'EventDates'), ['errorField' => 'event_date_id']);

        return $rules;
    }

    /**
     * @param  \App\Model\Entity\ReservationSlot  $entity  reservation_slot
     * @param  array  $data  data
     * @param  array  $options  options
     * @return \App\Model\Entity\ReservationSlot
     */
    public function patchAdminAddEntity(ReservationSlot $entity, array $data, array $options = []): ReservationSlot
    {
        $patchEntity = $this->patchEntity($entity, $data, $options);
        $patchEntity->remaining = $patchEntity->max;
        $patchEntity->version = 0;

        return $patchEntity;
    }
}
