<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>

<div class="content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Edit User') ?></legend>
        <span>First Name</span>
        <?php echo $this->Form->control('user_firstname',['label'=>false,'class'=>'form-control', 'style'=>'width: 200px', 'maxlength' => '45']); ?>

        <span>Last Name</span>
        <?php echo $this->Form->control('user_lastname',['label'=>false,'class'=>'form-control', 'style'=>'width: 200px', 'maxlength' => '45']); ?>
        <br>
        <span>User Type</span>
        <?php echo $this->Form->control('user_type',['label'=>false,'options'=>['client'=>'client','staff'=>'staff', 'admin'=>'admin'],'value'=>'client','empty'=>false,'class'=>'form-control', 'style'=>'width: 100px']);?>
        <br>
        <span>Email*</span>
        <?php echo $this->Form->control('user_email',['label'=>false,'type'=>'email','class'=>'form-control', 'style'=>'width: 350px','required'=>true ]);?>

        <span>Password*</span>
        <?php echo $this->Form->control('user_password',['id'=>'pwd', 'label'=>false,'type'=>'password','class'=>'form-control', 'style'=>'width: 350px','required'=>true ]);?>
        <label for="pass">Show Password </label>
        <input name="pass" type="checkbox" label=" Show Password" onclick="return showPassword()">

        <br>
        <span>Phone Number</span>
        <?php echo $this->Form->control('user_phone',['label'=>false, 'type'=>'number','class'=>'form-control', 'style'=>'width: 150px', 'maxlength' => '15']);?>
        <br>


    </fieldset>
    <?php echo $this->Html->link('Back',['controller'=>'Users','action'=>'index'],['class'=>'btn btn-secondary']) ?>
    <?= $this->Form->button('Submit',['class'=>'btn btn-primary']) ?>
    <?= $this->Form->end() ?>
</div>


<script>
    function showPassword() {
        var x = document.getElementById("pwd");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
