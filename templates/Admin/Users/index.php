<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>
<?php
$this->assign('title', __('List of {0}', __('Users')));
$this->Breadcrumbs->add([
    ['title' => $this->fetch('title'), 'url' => null],
]);
?>
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <?= $this->Html->link(__("Add {0}", __('User')), ['action' => 'add'], ['class' => 'btn btn-default']) ?>
        <?= $this->element('MyAdminLTE.pager') ?>
      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
                  <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('username') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                  <th scope="col" class="actions text-center"><?= __('Actions') ?></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($users as $user): ?>
                <tr>
                  <td><?= $this->Number->format($user->id) ?></td>
                  <td><?= h($user->username) ?></td>
                  <td><?= h($user->email) ?></td>
                  <td><?= h($user->created) ?></td>
                  <td><?= h($user->modified) ?></td>
                <td class="actions text-right">
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'btn btn-default btn-sm']) ?>
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