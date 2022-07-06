<?php
use Approval\Model\Type\ApprovalType;

/**
 * @var \App\View\AppView $this
 * @var string $model
 * @var string $wait
 * @var string|null $email
 */
?>
<div class="alert alert-warning alert-dismissible">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <?= $params['model']; ?>の<?= ApprovalType::list()[$params['wait']] ?? '' ?>を却下しました。
    <?php if ($params['email'] ?? false) : ?>
    <br>不承認の理由を[ <?= h($params['email']); ?> （<a class="btn btn-default btn-xs btn-warning" data-clipboard-text="<?= h($params['email']); ?>" href="#">メールアドレスをコピー</a>）] まで
    [ <a href="https://bvb.cybozu.com/g/mail/send.csp?aid=60&cid=359&sid=0" target="_blank">サイボウズメール</a> ] でお送りください。
    <?php endif; ?>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.6/clipboard.min.js"></script>
<script type="text/javascript">
    new ClipboardJS('.btn');
</script>
