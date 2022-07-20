<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ReservationSlot[]|\Cake\Collection\CollectionInterface $reservationSlots
 */
?>
<?php
$this->assign('title', __('List of {0}', __('Reservation Slots')));
$this->Breadcrumbs->add([
    ['title' => $this->fetch('title'), 'url' => null],
]);
?>
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <?= $this->Html->link(__("Add {0}", __('Reservation Slot')), ['action' => 'add'], ['class' => 'btn btn-default']) ?>
        <?= $this->element('MyAdminLTE.pager') ?>
      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
                  <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('max') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('remaining') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('time_from') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('time_to') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('version') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('event_date_id') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                  <th scope="col" class="actions text-center"><?= __('Actions') ?></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($reservationSlots as $reservationSlot): ?>
                <tr>
                  <td><?= $this->Number->format($reservationSlot->id) ?></td>
                  <td><?= $this->Number->format($reservationSlot->max) ?></td>
                  <td><?= $this->Number->format($reservationSlot->remaining) ?></td>
                  <td><?= h($reservationSlot->time_from) ?></td>
                  <td><?= h($reservationSlot->time_to) ?></td>
                  <td><?= $this->Number->format($reservationSlot->version) ?></td>
                  <td><?= $reservationSlot->has('event_date') ? $this->Html->link($reservationSlot->event_date->id, ['controller' => 'EventDates', 'action' => 'view', $reservationSlot->event_date->id]) : '' ?></td>
                  <td><?= h($reservationSlot->created) ?></td>
                  <td><?= h($reservationSlot->modified) ?></td>
                <td class="actions text-right">
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $reservationSlot->id], ['confirm' => __('Are you sure you want to delete # {0}?', $reservationSlot->id), 'class' => 'btn btn-default btn-sm']) ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
          <div>
              <?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?>
              <?= $this->element('MyAdminLTE.pager') ?>
          </div>
      </div>
    </div>
      <!-- /.box -->
  </div>
</div>