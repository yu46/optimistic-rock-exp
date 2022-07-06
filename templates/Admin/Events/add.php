<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Event $event
 */
?>
<?php
$this->assign('title', __('Add {0}', __('Event')));
$this->Breadcrumbs->add([
    ['title' => __('List of {0}', __('Events')), 'url' => ['action' => 'index']],
    ['title' => $this->fetch('title'), 'url' => null],
]);
?>
<?= $this->element('datetimepicker_js') ?>
<div class="row">
    <div class="col-md-12">
        <!-- general form elements -->
        <?php echo $this->Form->create($event, ['role' => 'form', 'novalidate' => true]); ?>
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo __('Form'); ?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">
                <table class="table table-bordered">
                    <tr>
                        <th><?php echo $this->Form->label('name'); ?></th>
                        <td><?php echo $this->Form->control('name'); ?>
                        </td>
                    </tr>
                    <tr>
                        <th><?= $this->Form->label('event_dates', '開催日', ['required' => true]) ?></th>
                        <td>
                            <?= $this->Form->control('event_dates', [
                                'id' => 'datepicker',
                                'type' => 'text',
                                'autocomplete' => 'off',
                                'templates' => [
                                    'inputContainer' => '<div class="col-sm-12 input no-padding {{type}}{{required}}">{{content}}</div>',
                                    'inputContainerError' => '<div class="col-sm-12 input no-padding {{type}}{{required}} has-error">{{content}}{{error}}</div>',
                                ],
                            ]) ?>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="box-footer text-center">
                <?php echo $this->Form->button(__('Submit'), [
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

