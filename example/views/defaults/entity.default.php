<div class="<?php if('label' !== $this->htmlType):?><?=$this->outerClass?> <?php endif?>has-<?=$this->status?> entity-container">
<?php
switch($this->htmlType) {
    case 'label':
        include __DIR__ . '/control/label.php';
        break;

    case 'checkbox':
        include __DIR__ . '/control/checkbox.php';
        break;

    case 'select':
        include __DIR__ . '/control/select.php';
        break;

    case 'textarea':
        include __DIR__ . '/control/textarea.php';
        break;

    default:
        include __DIR__ . '/control/default.php';
}
if ('label' !== $this->htmlType): ?>
    <div class="error-message">
        <?=$this->getMessage('<br/>');?>
    </div>
<?php endif ?>
</div>
