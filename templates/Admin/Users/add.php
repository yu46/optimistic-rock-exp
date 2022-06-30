<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<?php
$this->assign('title', __('Add {0}', __('User')));
$this->Breadcrumbs->add([
    ['title' => __('List of {0}', __('Users')), 'url' => ['action' => 'index']],
    ['title' => $this->fetch('title'), 'url' => null],
]);
?>
<div class="row">
    <div class="col-md-12">
        <!-- general form elements -->
        <?php echo $this->Form->create($user, ['role' => 'form', 'novalidate' => true]); ?>
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo __('Form'); ?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">
                <table class="table table-bordered">
                <tr>
                    <th><?php echo $this->Form->label('username'); ?></th>
                    <td><?php echo $this->Form->control('username'); ?>
                    </td>
                </tr>                <tr>
                    <th><?php echo $this->Form->label('email'); ?></th>
                    <td><?php echo $this->Form->control('email'); ?>
                    </td>
                </tr>                <tr>
                    <th><?php echo $this->Form->label('password'); ?></th>
                    <td><?php echo $this->Form->control('password'); ?>
                    </td>
                </tr>                </table>
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

