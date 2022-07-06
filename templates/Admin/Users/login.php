<?php
/**
 * @var \App\View\AppView $this
 */
?>
<?php
$this->assign('title', __('Login'));
?>
<div class="users form">
    <?= $this->Form->create() ?>
    <div class="form-group has-feedback">
        <?= $this->Form->control('email', ['placeholder' => __('Email')]) ?>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
        <?= $this->Form->control('password', ['placeholder' => __('Password')]) ?>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>
    <?= $this->Form->button(__('Login'), ['class' => 'btn btn-success']); ?>
    <?= $this->Form->end() ?>
</div>
