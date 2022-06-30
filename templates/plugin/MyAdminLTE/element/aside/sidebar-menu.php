<?php
/**
 * @var \App\View\AppView $this
 */
?>
<ul class="sidebar-menu" data-widget="tree">
    <li class="treeview active">
        <a href="#"><span><?= __('User') ?></span>
            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
        </a>
        <ul class="treeview-menu">
            <li><?= $this->Html->link(__('Add'), ['controller' => 'Users', 'action' => 'add']); ?></li>
            <li><?= $this->Html->link('一覧・編集', ['controller' => 'Users', 'action' => 'index']); ?></li>
        </ul>
    </li>
</ul>
