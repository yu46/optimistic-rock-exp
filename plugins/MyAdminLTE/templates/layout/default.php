<?php
/**
 * @var \App\View\AppView $this
 */
?>
<?php use Cake\Core\Configure; ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo Configure::read('Theme.title'); ?> | <?php echo $this->fetch('title'); ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <?php echo $this->Html->css('AdminLTE./bower_components/bootstrap/dist/css/bootstrap.min'); ?>
    <!-- Font Awesome -->
    <?php echo $this->Html->css('AdminLTE./bower_components/font-awesome/css/font-awesome.min'); ?>
    <!-- Ionicons -->
    <?php echo $this->Html->css('AdminLTE./bower_components/Ionicons/css/ionicons.min'); ?>
    <!-- Theme style -->
    <?php echo $this->Html->css('AdminLTE.AdminLTE.min'); ?>
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <?php echo $this->Html->css('AdminLTE.skins/skin-'. Configure::read('Theme.skin') .'.min'); ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <?php echo $this->fetch('css'); ?>
    <style>
        .table-bordered > thead > tr > th,
        .table-bordered > tbody > tr > th,
        .table-bordered > tfoot > tr > th,
        .table-bordered > thead > tr > td,
        .table-bordered > tbody > tr > td,
        .table-bordered > tfoot > tr > td  {
            border: 1px solid #e1e1e1;

        }
        th {
            background-color: rgba(100, 100, 100, 0.1);

        }
        .no-margin-left {
            margin-left: 0 !important;
        }
        .breadcrumb {
            background-color: #ffffff;

        }
        .main-header .logo{
            font-size: 18px;;
        }
        .step__list ul {
            margin: 0;
            padding: 0;
            margin-bottom: 20px;
            zoom: 1
        }
        .step__list ul:before, .step__list ul:after {
            content: " ";
            display: table
        }
        .step__list ul:after {
            clear: both
        }
        .step__list li {
            margin: 0;
            list-style: none;
            float: left;
            width: 18%;
            margin-right: 2%;
            padding: 7px 10px;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            background-color: #dbedf8;
            font-size: 16px;
            font-weight: bold;
            position: relative;
            text-align: center
        }
        .step__list li:after {
            content: " ";
            width: 0;
            height: 0;
            display: block;
            border: 8px solid transparent;
            border-left: 16px solid #dbedf8;
            position: absolute;
            right: -18px;
            top: 50%;
            margin-top: -8px
        }
        .step__list li.current {
            background-color: #58afe0;
            color: #fff
        }
        .step__list li.current:after {
            border: 8px solid transparent;
            border-left: 16px solid #58afe0
        }
        .step__list li:last-child {
            margin-right: 0
        }
        .step__list li:last-child:after {
            display: none;
        }
        .w-small { width: 120px; }
        .w-medium { width: 240px; }
        .w-large { width: 320px; }

        .min-w-small { min-width: 120px; }
        .min-w-medium { min-width: 240px; }
        .min-w-large { min-width: 320px; }

        .max-w-small { max-width: 120px; }
        .max-w-medium { max-width: 240px; }
        .max-w-large { max-width: 320px; }

        td .label {
            display: inline-block;
            padding: 3px;
            margin-right: 3px;
        }
    </style>
</head>
<body class="hold-transition skin-<?php echo Configure::read('Theme.skin'); ?>">
<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo $this->Url->build('/admin'); ?>" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><?php echo Configure::read('Theme.logo.mini'); ?></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><?php echo Configure::read('Theme.logo.large'); ?></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <?php echo $this->element('AdminLTE.nav-top'); ?>
    </header>

    <?php echo $this->element('AdminLTE.aside-main-sidebar'); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content-header">
            <h1><?= $this->fetch('title'); ?></h1>
        </section>
        <section class="content">
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo $this->Url->build(['controller' => 'Dashboards', 'action' => 'index']); ?>">
                        <i class="fa fa-dashboard"></i> <?php echo __('Dashboard'); ?>
                    </a>
                </li>
                <?php foreach($this->Breadcrumbs->getCrumbs() as $crumb) : ?>
                    <li><?= !empty($crumb['url']) ? $this->Html->link($crumb['title'], $crumb['url']) : h($crumb['title']); ?></li>
                <?php endforeach; ?>
            </ol>
            <?php echo $this->Flash->render(); ?>
            <?php echo $this->Flash->render('auth'); ?>
            <?php echo $this->fetch('content'); ?>
        </section>

    </div>
    <!-- /.content-wrapper -->

    <?php echo $this->element('AdminLTE.footer'); ?>

    <!-- Control Sidebar -->
    <?php echo $this->element('AdminLTE.aside-control-sidebar'); ?>
    <!-- /.control-sidebar -->

    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<?php echo $this->Html->script('AdminLTE./bower_components/jquery/dist/jquery.min'); ?>
<!-- Bootstrap 3.3.7 -->
<?php echo $this->Html->script('AdminLTE./bower_components/bootstrap/dist/js/bootstrap.min'); ?>
<!-- AdminLTE App -->
<?php echo $this->Html->script('AdminLTE.adminlte.min'); ?>

<?php echo $this->fetch('script'); ?>

<?php echo $this->fetch('scriptBottom'); ?>
<?php if (file_exists(WWW_ROOT . 'editor/templates.html')) : ?>
    <?php require_once WWW_ROOT . 'editor/templates.html'; ?>
<?php endif; ?>
</body>
</html>
