<div class="login">
    <?= $this->Html->image('2.png',['class'=>'img1']); ?>

    <div class="img">
        <?= $this->Html->image('1.png'); ?>
        <p>
            Smart Business Advisors</p>
    </div>
    <?= $this->Html->image('3.png',['class'=>'img2']); ?>
    <div class="box" style="height: 460px">

    <?php echo $this->Form->create($users,array('onsubmit' => 'return check(password,confirm_password);')); ?>
        <div class="logo">
            <?= $this->Html->image('logo.png'); ?>
            <span>Reset Password</span>
        </div>

        <div class="form">
            <p>Password</p>
            <?= $this->Form->control('password',['label' => false, 'required' => true, 'autofocus' => true, 'class' => 'form-control', 'placeholder' => 'New password']); ?>
        </div>
        <div class="form " >
            <p>Confirm Password</p>
            <?= $this->Form->control('confirm_password',['label' => false, 'type' => 'password', 'required' => true, 'class' => 'form-control', 'placeholder' => 'Retype new password']); ?>

        </div>




        <div class="btn">
            <?= $this->Form->button('Submit',['class' => 'btn btn-primary d-grid w-100']); ?>

        </div>
        <?php $this->Form->end(); ?>
    </div>
    <div class="bottom">
    </div>



    


    <script type="text/javascript">
    function check(password1, password2) {

        if (password1.value == password2.value) {

            return true;
        } else {
            alert("your password and confirm password is not same.");
            return false;
        }
    }
    </script>