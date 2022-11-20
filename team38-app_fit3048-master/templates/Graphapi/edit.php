<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Graphapi $graphapi
 */
?>
<div class="content">
    <?= $this->Form->create($graphapi) ?>
    <fieldset>
        <legend><?= __('Edit Microsoft Graph API details') ?></legend>

        <span>Tenant ID</span>
        <?php echo $this->Form->input('tenant_id',['label'=>false,'class'=>'form-control', 'style'=>'width: 400px', 'maxlength' => '45']); ?>

        <span>Client ID</span>
        <?php echo $this->Form->input('client_id',['label'=>false,'class'=>'form-control', 'style'=>'width: 400px', 'maxlength' => '45']); ?>

        <span>Client Secret</span>
        <?php echo $this->Form->input('client_secret',['label'=>false,'class'=>'form-control', 'style'=>'width: 400px', 'maxlength' => '45']); ?>

        <span>Email Inbox</span>
        <?php echo $this->Form->input('email',['label'=>false,'class'=>'form-control', 'style'=>'width: 400px', 'maxlength' => '45']); ?>
        <br>
    </fieldset>
    <?= $this->Form->button('Submit',['class'=>'btn btn-primary']) ?>
    <?= $this->Form->end() ?>
</div>
