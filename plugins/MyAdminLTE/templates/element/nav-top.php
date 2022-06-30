<?php

/**
 * @var \App\View\AppView $this
 */
?>
<nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a>
    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <li class="">
                <?php
                echo $this->Html->link(
                    '<i class="fa fa-sign-out"></i>' . __('Logout'),
                    ['plugin' => false, 'controller' => 'Users', 'action' => 'logout'],
                    ['class' => 'btn', 'escape' => false]
                );?>
            </li>
        </ul>
    </div>
</nav>
