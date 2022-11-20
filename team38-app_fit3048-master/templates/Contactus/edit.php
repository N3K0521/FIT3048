<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Contactus $contactus
 */
?>
<div class="content">
    <?= $this->Form->create($contactus) ?>
    <fieldset>
        <legend><?= __('Edit Contact Info') ?></legend>

        <span>Phone Number</span>
        <?php echo $this->Form->input('phone',['label'=>false,'class'=>'form-control', 'style'=>'width: 400px', 'maxlength' => '45']); ?>

        <span>Email</span>
        <?php echo $this->Form->input('email',['label'=>false,'class'=>'form-control', 'style'=>'width: 400px', 'maxlength' => '45']); ?>

        <span>Address</span>
        <?php echo $this->Form->input('address',['label'=>false,'class'=>'form-control', 'style'=>'width: 400px', 'maxlength' => '45']); ?>
        <br>
    </fieldset>
    <?= $this->Form->button('Submit',['class'=>'btn btn-primary']) ?>
    <?= $this->Form->end() ?>
</div>
