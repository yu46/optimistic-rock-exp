<?php
/**
 * @var \App\View\AppView $this
 */

?>
<?php
$this->assign('title', __('Dashboard'));
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-body table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th style="width: 30%"><?php echo __('Users') . '情報' ?></th>
                        <td>
                            <?= $this->Html->link('新規登録', [
                                'controller' => 'Users', 'action' => 'add'], ['class' => 'btn btn-default']) ?>
                            &nbsp;
                            <?= $this->Html->link('一覧・編集', [
                                'controller' => 'Users', 'action' => 'index'], ['class' => 'btn btn-default']) ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- /.box -->
    </div>
</div>
